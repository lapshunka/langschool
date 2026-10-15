<header class="site-header" style="background-color: #2b6cb0; color: white; padding: 15px 0;">
    <div class="container header-flex" style="display: flex; justify-content: space-between; align-items: center; max-width: 1000px; margin: 0 auto; padding: 0 20px;">
        <span class="logo" style="font-weight: bold; font-size: 1.2em;">Языковая школа</span>
        <nav class="menu">
            <a href="{{ route('home') }}" @class(['active' => request()->routeIs('home')]) style="color: white; text-decoration: none; margin-left: 15px; padding: 5px 10px; border-radius: 4px;">Главная</a>
            <a href="{{ route('courses.index') }}" @class(['active' => request()->routeIs('courses.*')]) style="color: white; text-decoration: none; margin-left: 15px; padding: 5px 10px; border-radius: 4px;">Курсы</a>
            <a href="{{ route('rules') }}" @class(['active' => request()->routeIs('rules')]) style="color: white; text-decoration: none; margin-left: 15px; padding: 5px 10px; border-radius: 4px;">Правила</a>
            <a href="{{ route('booking') }}" @class(['active' => request()->routeIs('booking')]) style="color: white; text-decoration: none; margin-left: 15px; padding: 5px 10px; border-radius: 4px;">Запись</a>
            <a href="{{ route('about') }}" @class(['active' => request()->routeIs('about')]) style="color: white; text-decoration: none; margin-left: 15px; padding: 5px 10px; border-radius: 4px;">О проекте</a>
            <a href="{{ route('contacts') }}" @class(['active' => request()->routeIs('contacts')]) style="color: white; text-decoration: none; margin-left: 15px; padding: 5px 10px; border-radius: 4px;">Контакты</a>
        </nav>
    </div>
</header>