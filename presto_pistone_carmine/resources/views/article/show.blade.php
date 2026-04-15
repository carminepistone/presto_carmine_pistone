<x-layout>
    @push('style')
    <style>
        body {
            background-image: url("{{ asset('img/show_bg.jpg') }}") !important;
            background-size: cover;
            background-attachment: fixed;
        }
        .details-container {
            background: rgba(255, 255, 255, 0.85);
            border-radius: 15px;
            backdrop-filter: blur(5px);
        }
    </style>
    @endpush

    <div class="container">
        <div class="row justify-content-center mt-5 py-4">
            <div class="col-12 text-center">
                <h1 class="display-4 fw-bold">{{ $article->title }}</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Home</a></li>
                        <li class="breadcrumb-item active">{{ __('ui.article_detail') }}</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row justify-content-center pb-5">
            <div class="col-12 col-md-6 mb-4">
                <livewire:remove-article-image :article="$article" />
            </div>
            
            <div class="col-12 col-md-6">
                <div class="details-container p-4 shadow-sm h-100 d-flex flex-column justify-content-between">
                    
                    <div>
                        <h3 class="text-success fw-bold mb-3">{{ $article->price }} €</h3>
                        <hr>
                        <h5>{{ __('ui.description') }}:</h5>
                        <p class="text-muted">{{ $article->description }}</p>
                        
                        <p class="mt-4">
                            <span class="badge bg-secondary py-2 px-3">
                                {{ __('ui.category') }}: {{ __("ui." . $article->category->name) }}
                            </span>
                        </p>
                    </div>

                    @auth
                        @if(Auth::user()->is_revisor)
                            <div class="mt-5 pt-3 border-top text-end">
                                <form action="{{ route('article.destroy', compact('article')) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-lg shadow-sm w-100 w-md-auto" onclick="confirmArticleDelete(this.form)">
                                        <i class="fas fa-trash-alt me-2"></i>{{ __('ui.delete_article') ?? 'Elimina Articolo' }}
                                    </button>
                                </form>
                            </div>
                        @endif
                    @endauth

                </div>
            </div>
        </div>
    </div>
</x-layout>