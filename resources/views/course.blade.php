<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Курс №{{ $id }} - {{ config('app.name') }}</title>
</head>
<body>
    <nav>
        <a href="{{ route('home') }}">Главная</a> |
        <a href="{{ route('about') }}">О проекте</a> |
        <a href="{{ route('contacts') }}">Контакты</a>
    </nav>
    <h1>Курс №{{ $id }}</h1>
    <p>Подробная информация о языковом курсе под номером {{ $id }}. На этом курсе вы улучшите навыки разговорной речи и грамматики.</p>
</body>
</html>