<nav class="navbar navbar-expand-lg bg-body-tertiary shadow">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="{{ route('homepage') }}">PRESTO</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                {{-- Homepage --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('homepage') }}">{{ __('ui.homepage') }}</a>
                </li>
                
                {{-- Tutti gli Articoli --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('article.index') }}">{{ __('ui.all_articles') }}</a>
                </li>
                
                {{-- Dropdown Categorie --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ __('ui.categories') }}
                    </a>
                    <ul class="dropdown-menu">
                        @foreach ($categories as $category)
                            <li>
                                <a class="dropdown-item text-capitalize" href="{{ route('byCategory', ['category' => $category]) }}">
                                    {{ __("ui." . $category->name) }}
                                </a>
                            </li>
                            @if (!$loop->last)
                                <hr class="dropdown-divider">
                            @endif
                        @endforeach
                    </ul>
                </li>

                {{-- Dropdown Account/Auth --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @auth
                            {{-- Nota: Ho usato 'Ciao' statico + nome, dato che nel tuo file 'hello' non c'era, 
                                 oppure puoi usare una stringa personalizzata --}}
                            Ciao, {{ Auth::user()->name }}
                        @else
                            {{ __('ui.hello_guest') }}
                        @endauth
                    </a>
                    <ul class="dropdown-menu">
                        @guest
                            <li><a class="dropdown-item" href="{{ route('login') }}">{{ __('ui.login') }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('register') }}">{{ __('ui.register') }}</a></li>
                        @endguest
                        
                        @auth
                            <li>
                                <a class="dropdown-item" href="{{ route('create.article') }}">{{ __('ui.publish_article') }}</a>
                            </li>
                            
                            {{-- Zona Revisore --}}
                            @if (Auth::user()->is_revisor)
                                <li>
                                    <a class="dropdown-item text-success position-relative" href="{{ route('revisor.index') }}">
                                        {{ __('ui.revisor_log') }}
                                        <span class="ms-2 badge rounded-pill bg-danger">
                                            {{ \App\Models\Article::toBerevisedCount() }}
                                        </span>
                                    </a>
                                </li>
                            @endif

                            <hr class="dropdown-divider">
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">Logout</button>
                                </form>
                            </li>
                        @endauth
                    </ul>
                </li>
            </ul>

            {{-- Form di Ricerca --}}
            <form class="d-flex" role="search" action="{{ route('article.search') }}" method="GET">
                <div class="input-group">
                    <input type="search" name="query" class="form-control" placeholder="{{ __('ui.search_placeholder') }}" aria-label="search">
                    <button type="submit" class="btn btn-outline-success">
                        {{ __('ui.search') }}
                    </button>
                </div>
            </form>

            {{-- Selettore Lingue --}}
            <div class="d-flex ms-3">
                <x-_locale lang="it"/>
                <x-_locale lang="uk"/>
                <x-_locale lang="es"/>
            </div>
        </div>
    </div>
</nav>