<header class="site-header" style="background-color: #2b6cb0; color: white; padding: 15px 0;">
    <div class="container header-flex" style="display: flex; justify-content: space-between; align-items: center; max-width: 1000px; margin: 0 auto; padding: 0 20px;">
        <span class="logo" style="font-weight: bold; font-size: 1.2em;">Языковая школа</span>
        <nav class="menu" style="display: flex; align-items: center; flex-wrap: wrap;">
            <a href="{{ route('home') }}" @class(['active' => request()->routeIs('home')]) style="color: white; text-decoration: none; margin-left: 15px; padding: 5px 10px; border-radius: 4px;">Главная</a>
            <a href="{{ route('courses.index') }}" @class(['active' => request()->routeIs('courses.*')]) style="color: white; text-decoration: none; margin-left: 15px; padding: 5px 10px; border-radius: 4px;">Курсы</a>
            <a href="{{ route('rules') }}" @class(['active' => request()->routeIs('rules')]) style="color: white; text-decoration: none; margin-left: 15px; padding: 5px 10px; border-radius: 4px;">Правила</a>
            <a href="{{ route('booking') }}" @class(['active' => request()->routeIs('booking')]) style="color: white; text-decoration: none; margin-left: 15px; padding: 5px 10px; border-radius: 4px;">Запись</a>
            <a href="{{ route('about') }}" @class(['active' => request()->routeIs('about')]) style="color: white; text-decoration: none; margin-left: 15px; padding: 5px 10px; border-radius: 4px;">О проекте</a>
            <a href="{{ route('contacts') }}" @class(['active' => request()->routeIs('contacts')]) style="color: white; text-decoration: none; margin-left: 15px; padding: 5px 10px; border-radius: 4px;">Контакты</a>

            {{-- Для гостя: Кнопки Входа и Регистрации --}}
            @guest
                <a href="{{ route('login') }}" @class(['active' => request()->routeIs('login')]) style="color: white; text-decoration: none; margin-left: 15px; padding: 5px 10px; border-radius: 4px; background: rgba(255,255,255,0.15);">Вход</a>
                <a href="{{ route('register') }}" @class(['active' => request()->routeIs('register')]) style="color: white; text-decoration: none; margin-left: 15px; padding: 5px 10px; border-radius: 4px; background: rgba(255,255,255,0.3);">Регистрация</a>
            @endguest

            {{-- Для авторизованного пользователя --}}
            @auth
                {{-- Ссылка на профиль (ЛР9, Задание 2) --}}
                <a href="{{ route('profile') }}" @class(['active' => request()->routeIs('profile')]) style="color: white; text-decoration: none; margin-left: 15px; padding: 5px 10px; border-radius: 4px; background: rgba(255,255,255,0.1);"> Профиль</a>

                {{-- Колокольчик уведомлений для администратора (ЛР9, Задание 5) --}}
                @can('admin-panel')
                    <a href="{{ route('admin.notifications') }}" style="color: white; text-decoration: none; margin-left: 15px; padding: 5px 10px; border-radius: 4px; background: #2c5282; position: relative;">
                        🔔 
                        @if(auth()->user()->unreadNotifications->count() > 0)
                            <span style="background: #e53e3e; color: white; border-radius: 999px; padding: 1px 6px; font-size: 0.75em; font-weight: bold;">
                                {{ auth()->user()->unreadNotifications->count() }}
                            </span>
                        @endif
                    </a>
                    <a href="{{ route('admin.dashboard') }}" style="color: white; text-decoration: none; margin-left: 15px; padding: 5px 10px; border-radius: 4px; background: #d69e2e;">Админ-панель</a>
                @endcan

                <span style="color: #f7fafc; font-weight: bold; margin-left: 15px;">{{ auth()->user()->name }}</span>

                {{-- Кнопка выхода (через POST-форму для защиты от CSRF) --}}
                <form action="{{ route('logout') }}" method="POST" style="display: inline; margin-left: 15px;">
                    @csrf
                    <button type="submit" style="background: #e53e3e; border: none; color: white; cursor: pointer; padding: 5px 10px; border-radius: 4px; font: inherit; font-weight: bold;">Выйти</button>
                </form>
            @endauth
        </nav>
    </div>
</header>