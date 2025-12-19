<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>
<body>
    <header class="header">
        <div class="header__nav">
            <div class="header__title title-family">
                <a href="/">FashionablyLate</a>
            </div>
            <div class="header__buttons">
                @guest
                    @if (request()->is('login'))
                        <a href="/register" class="header__button">Register</a>
                    @elseif (request()->is('register'))
                        <a href="/login" class="header__button">Login</a>
                    @endif
                @endguest
    
                @auth
                    <form action="/logout" method="POST" >
                        @csrf
                        <button type="submit" class="header__button">Logout</button>
                    </form>
                @endauth
            </div>
        </div>
    </header>
    <main>
        @yield('content')
    </main>
</body>
</html>