<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Запись - {{ config('app.name') }}</title>
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
    <h1>Записаться на пробный урок</h1>
    <form>
        <button type="button">Отправить заявку</button>
    </form>
</body>
</html>