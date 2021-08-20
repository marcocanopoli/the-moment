<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">        
        <title>{{ config('app.name', 'The Moment') }}</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/front.css') }}" rel="stylesheet">
    </head>
    <body>

        @if (session('logout'))
            <div role="alert">
                {{ session('logout') }}
            </div>
        @endif 

        {{-- @if (Route::has('login'))
            <div>
                @auth
                    <a href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
                @else
                    <a href="{{ route('login') }}">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </div>
        @endif --}}
        
        <div id="root"></div>   

        <!-- Scripts -->
        <script src="{{ asset('js/front.js') }}"></script>
    </body>
</html>
