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
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <header>
        <nav class="navbar" role="navigation" aria-label="main navigation">
            <div class="navbar-brand">
                <a class="navbar-item" href="{{ url('/') }}">
                <img src="https://storage.googleapis.com/wfhq_flatbelly/img/logo-pure.png" alt="{{ config('app.name', 'Laravel') }}">
                </a>
                <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                </a>
            </div>
            @auth
            <div class="navbar-start">
                <a class="navbar-item" href="/admin/products">
                    Products
                </a>
                <a class="navbar-item" href="/admin/users">
                    Users
                </a>
            </div>
            @endauth
            <div class="navbar-end">
                    @guest
                    <div class="navbar-item">
                        <div class="buttons">
                            <a class="button is-primary" href="{{ route('register') }}">
                                <strong>{{ __('Register') }}</strong>
                            </a>
                            <a class="button is-light" href="{{ route('login') }}">
                                {{ __('Login') }}
                            </a>
                        </div>
                    </div>
                    @else
                    <a class="navbar-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                    </form>
                    @endguest
            </div>
        </nav>
    </header>
    <div id="app">
        <main class="py-4">
                @yield('content')
        </main>
    </div>
</body>
</html>
