<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('metas')
    <!-- Scripts -->
    <script src="{{ asset('js/store.js') }}" defer></script>
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
            </div>
            <div class="navbar-end">
                    <div class="navbar-item">
                        <div class="buttons">
                            <a class="button is-light" href="{{ route('register') }}">
                                <span>Admin</span>
                            </a>
                            <a class="button is-warning" href="/cart">
                                <span class="icon is-small">
                                <i class="fa fa-shopping-cart"></i>
                                </span>
                                <span>{{\Cart::count()}}</span>
                            </a>
                        </div>
                    </div>                  
            </div>
        </nav>
    </header>
    <main>
        @yield('content')
    </main>
</body>
</html>
