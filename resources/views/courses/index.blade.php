<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Список курсов - {{ config('app.name') }}</title>
</head>
<body>
    <nav>
    <a href="{{ route('home') }}">Главная</a> |
    <a href="{{ route('courses.index') }}">Курсы</a> |
    <a href="{{ route('rules') }}">Правила</a> |
    <a href="{{ route('booking') }}">Запись</a> |
    <a href="{{ route('about') }}">О проекте</a> |
    <a href="{{ route('contacts') }}">Контакты</a>
</nav>
    <h1>Доступные курсы языковой школы</h1>
    <ul>
        @foreach ($items as $id => $item)
            <li><a href="{{ route('courses.show', $id) }}">{{ $item['title'] }}</a></li>
        @endforeach
    </ul>
</body>
</html>