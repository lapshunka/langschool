<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
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
    <h1>{{ config('app.name') }}</h1>
    <p>Добро пожаловать на официальный сайт нашей языковой школы! Изучайте английский, немецкий и другие языки с профессиональными преподавателями.</p>
    <p>Сегодня: {{ now()->format('d.m.Y') }}</p>
</body>
</html>