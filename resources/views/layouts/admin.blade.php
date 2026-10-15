<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Админ-панель — Языковая школа')</title>
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
</head>
<body class="admin-body">
    <div class="petals-container">
        <div class="petal"></div>
        <div class="petal"></div>
        <div class="petal"></div>
        <div class="petal"></div>
        <div class="petal"></div>
        <div class="petal"></div>
    </div>

    <header class="site-header" style="background: linear-gradient(135deg, #7b1fa2, #512da8);">
        <div class="container header-flex">
            <span class="logo" style="font-weight: bold; color: white;">Панель администратора</span>
            <nav class="menu">
                <a href="{{ route('admin.dashboard') }}" @class(['active' => request()->routeIs('admin.dashboard')])>Панель</a>
                <a href="{{ route('admin.courses') }}" @class(['active' => request()->routeIs('admin.courses*')])>Курсы</a>
                <a href="{{ route('admin.logout') }}">Выход</a>
            </nav>
        </div>
    </header>

    <main class="container" style="padding: 30px 20px; min-height: 70vh;">
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="container">
            <p>&copy; {{ date('Y') }} Языковая школа (Админ-панель)</p>
        </div>
    </footer>
</body>
</html>