<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>{{ $item['title'] }} - {{ config('app.name') }}</title>
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
    <h1>{{ $item['title'] }}</h1>
    <p><strong>Уровень:</strong> {{ $item['level'] }}</p>
    <p><strong>Стоимость:</strong> {{ $item['price'] }} тг</p>
    
    <p><a href="{{ route('courses.index') }}">← Назад к списку курсов</a></p>
</body>
</html>