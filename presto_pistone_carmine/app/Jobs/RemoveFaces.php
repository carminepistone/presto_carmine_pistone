<?php

namespace App\Jobs;

use App\Models\Image;
use Google\Cloud\Vision\V1\AnnotateImageRequest;
use Google\Cloud\Vision\V1\BatchAnnotateImagesRequest;
use Google\Cloud\Vision\V1\Client\ImageAnnotatorClient;
use Google\Cloud\Vision\V1\Feature;
use Google\Cloud\Vision\V1\Feature\Type;
use Google\Cloud\Vision\V1\Image as VisionImage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Spatie\Image\Enums\AlignPosition;
use Spatie\Image\Enums\Fit;
use Spatie\Image\Image as SpatieImage;

class RemoveFaces implements ShouldQueue
{
    use Queueable;

    private int $article_image_id;

    /**
     * Create a new job instance.
     */
    public function __construct(int $article_image_id)
    {
        $this->article_image_id = $article_image_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $imageModel = Image::find($this->article_image_id);

        if (!$imageModel) {
            Log::warning('RemoveFaces: model not found', [
                'image_id' => $this->article_image_id,
            ]);
            return;
        }

        $src = storage_path('app/public/' . $imageModel->path);

        if (!file_exists($src)) {
            Log::warning('RemoveFaces: file not found on disk', [
                'image_id' => $this->article_image_id,
                'path'     => $src,
            ]);
            return;
        }

        $googleVisionClient = null;

        try {
            // FIX: variabile rinominata per evitare conflitto di tipo con SpatieImage
            $rawImageContent = file_get_contents($src);

            if ($rawImageContent === false) {
                throw new \RuntimeException("Unable to read file: {$src}");
            }

            // FIX: credenziali passate via costruttore, sicuro anche con worker concorrenti
            $googleVisionClient = new ImageAnnotatorClient([
                'credentials' => base_path('google_credential.json'),
            ]);

            $visionImage = new VisionImage(['content' => $rawImageContent]);

            $feature = new Feature();
            $feature->setType(Type::FACE_DETECTION);

            $request = new AnnotateImageRequest();
            $request->setImage($visionImage);
            $request->setFeatures([$feature]);

            $batchRequest = new BatchAnnotateImagesRequest();
            $batchRequest->setRequests([$request]);

            $responseBatch = $googleVisionClient->batchAnnotateImages($batchRequest);
            $faces         = $responseBatch->getResponses()[0]->getFaceAnnotations();

            // Nessuna faccia rilevata: niente da fare
            if (count($faces) === 0) {
                Log::info('RemoveFaces: no faces detected', [
                    'image_id' => $this->article_image_id,
                ]);
                return;
            }

            // FIX: SpatieImage caricata UNA SOLA VOLTA fuori dal loop
            $spatieImage = SpatieImage::load($src);

            foreach ($faces as $face) {
                $vertices = $face->getBoundingPoly()->getVertices();

                // FIX: raccolta bounds con array_map per chiarezza e brevità
                $bounds = array_map(
                    fn($vertex) => [$vertex->getX(), $vertex->getY()],
                    iterator_to_array($vertices)
                );

                $w = $bounds[2][0] - $bounds[0][0];
                $h = $bounds[2][1] - $bounds[0][1];

                // FIX: watermark applicato in catena sullo stesso oggetto
                $spatieImage->watermark(
                    base_path('resources/img/face.png'),
                    AlignPosition::TopLeft,
                    paddingX: $bounds[0][0],
                    paddingY: $bounds[0][1],
                    width:    $w,
                    height:   $h,
                    fit:      Fit::Stretch
                );
            }

            // FIX: salvataggio eseguito UNA SOLA VOLTA dopo il loop
            $spatieImage->save($src);

            Log::info('RemoveFaces: completed', [
                'image_id'    => $this->article_image_id,
                'faces_found' => count($faces),
            ]);

        } catch (\Throwable $e) {
            Log::error('RemoveFaces: job failed', [
                'image_id' => $this->article_image_id,
                'error'    => $e->getMessage(),
                'trace'    => $e->getTraceAsString(),
            ]);

            // Rilancia per attivare il meccanismo di retry del queue worker
            throw $e;

        } finally {
            // FIX: close() garantito anche in caso di eccezione
            $googleVisionClient?->close();
        }
    }
}