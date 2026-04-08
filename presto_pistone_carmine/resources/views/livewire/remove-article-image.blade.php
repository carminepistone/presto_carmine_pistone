<div>
    @if ($article->images->count() > 0)
        <div id="carouselExample" class="carousel slide">
            <div class="carousel-inner">
                @foreach ($article->images as $key => $image)
                    <div class="carousel-item @if ($loop->first) active @endif">
                        <img src="{{ $image->getUrl(300, 300) }}" 
                             class="d-block w-100 rounded shadow" 
                             alt="Immagine {{ $key + 1 }} di {{ $article->title }}">


                        @if(Auth::check() && Auth::user()->isRevisor())
                            <button 
                                wire:click="removeImage({{ $image->id }})"
                                wire:confirm="Sei sicuro di voler eliminare questa immagine?"
                                class="btn btn-danger mt-5">
                                <i class="fas fa-trash me-1"></i> Elimina immagine
                            </button>
                        @endif
                    </div>
                @endforeach
            </div>

            @if ($article->images->count() > 1)
                <button class="carousel-control-prev" type="button" 
                        data-bs-target="#carouselExample" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </button>
                <button class="carousel-control-next" type="button" 
                        data-bs-target="#carouselExample" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </button>
            @endif
        </div>
    @else
        <img src="https://picsum.photos/400" 
             class="d-block w-100 rounded shadow" 
             alt="Nessuna immagine">
    @endif
</div>