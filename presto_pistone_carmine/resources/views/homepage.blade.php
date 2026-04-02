<x-layout>
    <div class="container-fluid text-center">

        <div class="row min-vh-100 justify-content-center align-items-center g-0">
            <div class="col-12">
                <div class="my-3">
                    @auth
                        <a class="btn btn-account" href="{{ route('create.article') }}">{{ __('ui.publish_article') }}</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    {{-- Alert) --}}
    <div class="container d-flex justify-content-center">
        @if (session()->has('errorMessage'))
            <div class="alert alert-danger text-center shadow rounded w-50">
                {{ session('errorMessage') }}
            </div>
        @endif
        @if (session()->has('message'))
            <div class="alert alert-success text-center shadow rounded w-50">
                {{ session('message') }}
            </div>
        @endif
    </div>

    {{-- Articoli --}}
    <div class="container py-5">
        <div class="row justify-content-center align-items-center">
            @forelse ($articles as $article)
                <div class="col-12 col-md-3 mb-4">
                    <x-card :article="$article" />
                </div>
            @empty
                <div class="col-12">
                    <h3 class="text-center text-black">
                        {{ __('ui.no_articles') }}
                    </h3>
                </div>
            @endforelse
        </div>
    </div>
</x-layout>