<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Админ-панель — Языковая школа')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @if (session('success'))
        <x-alert type="success">{{ session('success') }}</x-alert>
    @endif

    @if (session('error'))
        <x-alert type="error">{{ session('error') }}</x-alert>
    @endif
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
        <div class="container header-flex" style="display: flex; justify-content: space-between; align-items: center;">
            <span class="logo" style="font-weight: bold; color: white;">Панель администратора</span>
            <nav class="menu" style="display: flex; align-items: center; gap: 10px;">
                <a href="{{ route('admin.dashboard') }}" @class(['active' => request()->routeIs('admin.dashboard')])>Панель</a>
                <a href="{{ route('admin.courses.index') }}" @class(['active' => request()->routeIs('admin.courses*')])>Курсы</a>
                <a href="{{ route('admin.languages.index') }}" @class(['active' => request()->routeIs('admin.languages*')])>Языки</a>
                
                {{-- Иконка уведомлений с количеством непрочитанных --}}
                @auth
                    @php
                        $unreadCount = auth()->user()->unreadNotifications->count();
                    @endphp
                    <a href="{{ route('admin.notifications') }}" @class(['active' => request()->routeIs('admin.notifications')]) style="position: relative; text-decoration: none;">
                        🔔 
                        @if($unreadCount > 0)
                            <span style="background: #e53e3e; color: white; border-radius: 50%; padding: 1px 5px; font-size: 0.75em; font-weight: bold;">
                                {{ $unreadCount }}
                            </span>
                        @endif
                    </a>
                @endauth

                {{-- Информация о текущем пользователе и кнопка выхода через POST --}}
                @auth
                    <span style="color: #e2e8f0; font-size: 0.9em; margin-left: 5px;">{{ auth()->user()->name }} ({{ auth()->user()->role }})</span>
                    <a href="{{ route('courses.index') }}" style="color: #fff; text-decoration: underline;">Сайт</a>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline; margin: 0;">
                        @csrf
                        <button type="submit" style="background: #e53e3e; border: none; color: white; padding: 5px 10px; border-radius: 4px; cursor: pointer; font: inherit; font-size: 0.9em;">Выход</button>
                    </form>
                @endauth
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