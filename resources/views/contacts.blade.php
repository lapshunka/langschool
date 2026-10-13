<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Контакты - {{ config('app.name') }}</title>
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
    <h1>Контакты</h1>
    <p><strong>Адрес:</strong> {{ $address }}</p>
    <p><strong>Телефон:</strong> {{ $phone }}</p>
    <p><strong>E-mail:</strong> {{ $email }}</p>
</body>
</html>