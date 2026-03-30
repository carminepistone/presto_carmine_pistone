<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="#">PRESTO</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('homepage') }}">Homepage</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('article.index') }}">Tutti gli Articoli</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Categorie
                    </a>
                    <ul class="dropdown-menu">
                        @foreach ($categories as $category)
                            <li>
                                <a class="dropdown-item text-capitalize"
                                    href="{{ route('byCategory', ['category' => $category]) }}">{{ $category->name }}</a>
                            </li>
                            @if (!$loop->last)
                                <hr class="dropdown-divider">
                            @endif
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            @auth
                                Ciao, {{ Auth::user()->name }}
                            @else
                                Ciao, ospite
                            @endauth
                        </button>

                        <ul class="dropdown-menu">
                            @guest
                                <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
                                <li><a class="dropdown-item" href="{{ route('register') }}">Registrati</a></li>
                            @endguest
                            @auth
                                <li>
                                    <a class="dropdown-item" href="{{ route('create.article')}}">Crea un articolo</a>
                                </li>
                                    @if (Auth::user()->is_revisor)
                                        <li class="nav-item">
                                            <a class="dropdown-item text-success position-relative"
                                                href="{{ route('revisor.index') }}">
                                                Zona revisore
                                                <span class="position-absolute top-50 end-0 translate-middle-y badge rounded-pill bg-danger mx-2">
                                                    {{ \App\Models\Article::toBerevisedCount() }}
                                                </span>
                                            </a>
                                        </li>
                                    @endif
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            Logout
                                        </button>
                                    </form>
                                </li>
                            @endauth
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
            <form class="d-flex ms-auto" role="search" action="{{ route('article.search') }}" method="GET">
                <div class="input-group">
                    <input type="search" name="query" class="form-control" placeholder="Search" aria-label="search">
                    <button type="submit" class="input-group-text btn btn-outline-success"
                                    id="basic-addon2">
                                    Search
                    </button>
                </div>
            </form>
    </div>
</nav>
