<?php
namespace App\Livewire;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;

class RemoveArticleImage extends Component
{
    public $article;

public function removeImage($imageId)
{

    if (!Auth::user()->isRevisor()) {
        abort(403, 'Non sei autorizzato!');
    }

    $image = Image::findOrFail($imageId);

    if ($image->article_id !== $this->article->id) {
        abort(403);
    }

    Storage::disk('public')->delete($image->path);
    $image->delete();
}

    public function render()
    {

        $this->article->load('images');
        return view('livewire.remove-article-image');
    }
}