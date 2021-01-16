<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/script.js') }}" defer></script>
    <script src="https://kit.fontawesome.com/e7858c52b6.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Shadows+Into+Light&display=swap" rel="stylesheet">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo asset('css/style.css')?>" type="text/css">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark sticky-top" id="top">
            <img src="{{ asset('img/logo.png') }}" class="logo" alt="logo">
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <!-- Left Side Of Navbar -->
                    <div class="navbar-nav">
                        <a href="{{ route('home') }}" class="nav-item nav-link">Domov</a>
                        <a href="{{ route('news') }}" class="nav-item nav-link">Novinky</a>
                        <a href="" class="nav-item nav-link">Súhvezdia</a>
                    </div>

                    <!-- Right Side Of Navbar -->
                    <div class="navbar-nav ml-auto">
                            @auth
                                @can('create',\App\Models\User::class)
                                    <a class="nav-link" href="{{ route('user.index') }}">Používatelia</a>
                                @endcan
                            @endauth
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <div class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Prihlásiť sa</a>
                                </div>
                            @endif

                            @if (Route::has('register'))
                                <div class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Registrovať sa</a>
                                </div>
                            @endif
                        @else
                            <div class="nav-item">
                                <a class="nav-link">
                                    {{ Auth::user()->name }}
                                </a>

                            </div>
                            <div class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Odhlásiť sa</a>
                            </div>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                        @endguest
                    </div>
                </div>
        </nav>
    </div>
        <main>
            @yield('content')
        </main>

    <div class="container col-md-12 align-content-center">
        <footer class="page-footer font-small unique-color-dark pt-4">
            <div class="footer-copyright text-center py-3">© 2020 Copyright:
                Martin Scasny
            </div>
        </footer>
    </div>
</body>
</html>
