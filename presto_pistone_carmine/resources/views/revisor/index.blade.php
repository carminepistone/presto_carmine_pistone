<x-layout>
    @push('style')
    <style>
        body {
            background-image: url("{{ asset('img/revisor_bg.jpg') }}") !important;
            background-size: cover;
            background-attachment: fixed;
        }
        /* Classe di supporto per uniformare le box se necessario */
        .revisor-card-custom {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
        }
    </style>
    @endpush

    <div class="container-fluid pt-5">
        <div class="row justify-content-center mt-5">
            <div class="col-3">
                <div class="rounded shadow bg-body-secondary">
                    <h1 class="display-5 text-center revisor-div pb-2">
                        {{ __('ui.revisor_log') }}
                    </h1>
                </div>
            </div>
        </div>

        @if (session()->has('message'))
            <div class="row justify-content-center">
                <div class="col-5 alert alert-success text-center shadow rounded">
                    {{ session('message') }}
                </div>
            </div>
        @endif

        @if ($article_to_check)
            <div class="row justify-content-center pt-5">
                <div class="col-md-8">
                    <div class="row justify-content-center">
                        @if ($article_to_check->images->count())
                            @foreach ($article_to_check->images as $key => $image)
                                <div class="col-12 revisor-card-custom shadow mb-5 p-4">
                                    <div class="row align-items-center">
                                        <div class="col-md-4">
                                            <img src="{{ $image->getUrl(300,300) }}"
                                                class="img-fluid rounded shadow-sm w-100"
                                                alt="Immagine {{ $key + 1 }} dell'articolo '{{ $article_to_check->title }}'">
                                        </div>

                                        <div class="col-md-4 border-start border-end">
                                            <h5 class="text-center border-bottom pb-2">Labels</h5>
                                            <div class="d-flex flex-wrap justify-content-center mt-3">
                                                @if ($image->labels)
                                                    @foreach ($image->labels as $label)
                                                        <span class="badge rounded-pill bg-info text-dark m-1 shadow-sm">
                                                            #{{ $label }}
                                                        </span>
                                                    @endforeach
                                                @else
                                                    <p class="fst-italic text-muted">No labels detected</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h5 class="text-center border-bottom pb-2">Ratings</h5>
                                            <div class="mt-3">
                                                @php
                                                    $categories = [
                                                        'adult' => $image->adult,
                                                        'violence' => $image->violence,
                                                        'spoof' => $image->spoof,
                                                        'racy' => $image->racy,
                                                        'medical' => $image->medical
                                                    ];
                                                @endphp

                                                @foreach ($categories as $name => $iconClass)
                                                    <div class="row mb-2 align-items-center">
                                                        <div class="col-5 text-end text-capitalize small fw-bold">{{ $name }}:</div>
                                                        <div class="col-7">
                                                            <i class="{{ $iconClass }} fs-5"></i>
                                                            <span class="small text-muted ms-2">check</span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        </div>
                                </div>
                            @endforeach
                        @else
                            {{-- Placeholder se non ci sono immagini --}}
                            @for ($i = 0; $i < 6; $i++)
                                <div class="col-6 col-md-4 mb-4 text-center">
                                    <img src="https://picsum.photos/300" class="img-fluid rounded shadow">
                                </div>
                            @endfor
                        @endif
                    </div>
                </div>

                {{-- Colonna Dettagli Articolo e Bottoni --}}
                <div class="col-md-4">
                    <div class="sticky-top" style="top: 100px;">
                        <div class="revisor-card-custom shadow p-4 box-article">
                            <h1>{{ $article_to_check->title }}</h1>
                            <hr>
                            <p><strong>{{ __('ui.author') }}:</strong> {{ $article_to_check->user->name }}</p>
                            <p class="h4 text-success fw-bold">{{ $article_to_check->price }}€</p>
                            <p class="badge bg-secondary">{{ $article_to_check->category->name }}</p>
                            <p class="mt-3">{{ $article_to_check->description }}</p>
                            
                            <div class="d-flex justify-content-between mt-5">
                                <form action="{{ route('reject', ['article' => $article_to_check]) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-danger btn-lg shadow">{{ __('ui.reject') }}</button>
                                </form>
                                <form action="{{ route('accept', ['article' => $article_to_check]) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-success btn-lg shadow">{{ __('ui.accept') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row justify-content-center align-items-center height-custom text-center">
                <div class="col-12">
                    <h1 class="fst-italic display-4">
                        {{ __('ui.no_revision') }}
                    </h1>
                    <a href="{{ route('homepage') }}" class="mt-5 btn btn-home btn-lg shadow">{{ __('ui.back.homepage') }}</a>
                </div>
            </div>
        @endif
    </div>
</x-layout>