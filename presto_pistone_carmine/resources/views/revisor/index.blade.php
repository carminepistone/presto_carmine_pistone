<x-layout>
        @push('style')
    <style>
        body {
            background-image: url("{{ asset('img/revisor_bg.jpg') }}") !important;
            background-size: cover;
            background-attachment: fixed;
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
                                <div class="col-md-4 mb-4">
                                    <img src="{{ $image->getUrl(300,300) }}"
                                        class="img-fluid rounded shadow"
                                        alt="Immagine {{ $key + 1 }} dell'articolo '{{ $article_to_check->title }}'">
                                </div>
                                <div class="col-md-3 ps-3">
                                    <div class="card-body labels-box">
                                        <h5>Labels</h5>
                                        @if ($image->labels)
                                            @foreach ($image->labels as $label)
                                                #{{ $label }},
                                            @endforeach
                                        @else
                                            <p class="fst-italic">No labels</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-5 ps-3 ">
                                    <div class="card-body ratings-box">
                                        <h5>Ratings</h5>
                                        <div class="row justify-content-center">
                                            <div class="col-2">
                                                <i class="{{ $image->adult }}"></i>
                                            </div>
                                            <div class="col-10">adult</div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-2">
                                                <i class="{{ $image->violence }}"></i>
                                            </div>
                                            <div class="col-10">violence</div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-2">
                                                <i class="{{ $image->spoof }}"></i>
                                            </div>
                                            <div class="col-10">spoof</div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-2">
                                                <i class="{{ $image->racy }}"></i>
                                            </div>
                                            <div class="col-10">racy</div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-2">
                                                <i class="{{ $image->medical }}"></i>
                                            </div>
                                            <div class="col-10">medical</div>
                                        </div>
                                    </div>
                                </div>


                            @endforeach
                        @else
                            @for ($i = 0; $i < 6; $i++)
                                <div class="col-6 col-md-4 mb-4 text-center">
                                    <img src="https://picsum.photos/300"
                                        alt="{{ __('ui.placeholder_image') }}"
                                        class="img-fluid rounded shadow">
                                </div>
                            @endfor
                        @endif
                    </div>
                </div>
                <div class="col-md-4 d-flex flex-column justify-content-between box-article">
                    <div>
                        <h1>{{ $article_to_check->title }}</h1>
                        <h3>{{ __('ui.author') }}: {{ $article_to_check->user->name }}</h3>
                        <h4>{{ $article_to_check->price }}€</h4>
                        <h4 class="fst-italic text-muted">{{ $article_to_check->category->name }}</h4>
                        <p class="h6">{{ $article_to_check->description }}</p>
                    </div>
                    <div class="d-flex pb-4 justify-content-around">
                        <form action="{{ route('reject', ['article' => $article_to_check]) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-danger py-2 px-5 fw-bold">{{ __('ui.reject') }}</button>
                        </form>
                        <form action="{{ route('accept', ['article' => $article_to_check]) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-success py-2 px-5 fw-bold">{{ __('ui.accept') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        @else
            <div class="row justify-content-center align-items-center height-custom text-center">
                <div class="col-12">
                    <h1 class="fst-italic display-4">
                        {{ __('ui.no_revision') }}
                    </h1>
                    <a href="{{ route('homepage') }}" class="mt-5 btn btn-home">{{ __('ui.back.homepage') }}</a>
                </div>
            </div>
        @endif
    </div>
</x-layout>