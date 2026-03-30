<div class="card mx-auto card-w shadow text-center mb-3">
    <img src="{{$article->images->isNotEmpty() ? Storage::url($article->images->first()->path) : 'https://picsum.photos/200'}}" class="card-img-top" alt="{{ __('ui.article_detail') }} {{ $article->title }}">
    
    <div class="card-body">
        <h4 class="card-title">{{ $article->title }}</h4>
        <h6 class="card-subtitle text-body-secondary">{{ $article->price }} €</h6>
        <div class="d-flex justify-content-evenly align-items-center mt-5">
            {{-- Pulsante Dettaglio --}}
            <a href="{{ route('article.show', compact('article')) }}" class="btn btn-primary">
                {{ __('ui.detail') }}
            </a>
            
            {{-- Pulsante Categoria (Tradotto Dinamicamente) --}}
            <a href="{{ route('byCategory', ['category' => $article->category]) }}" class="btn btn-outline-info">
                {{ __("ui." . $article->category->name) }}
            </a>
        </div>
    </div>
</div>