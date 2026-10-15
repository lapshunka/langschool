<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Языковая школа')</title>
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
</head>
<body>
    <div class="petals-container">
        <div class="petal"></div>
        <div class="petal"></div>
        <div class="petal"></div>
        <div class="petal"></div>
        <div class="petal"></div>
        <div class="petal"></div>
    </div>

    @include('partials.nav')

    <main class="container">
        @yield('content')
    </main>

    @include('partials.footer')
</body>
</html>