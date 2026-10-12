<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>О проекте - {{ config('app.name') }}</title>
</head>
<body>
    <nav>
        <a href="{{ route('home') }}">Главная</a> |
        <a href="{{ route('about') }}">О проекте</a> |
        <a href="{{ route('contacts') }}">Контакты</a>
    </nav>
    <h1>О проекте</h1>
    <p><strong>Разработчик:</strong> {{ $fio }}</p>
    <p><strong>Группа:</strong> {{ $group }}</p>
    <p>Проект «Языковая школа» разработан в рамках лабораторных работ по производственному обучению. Здесь пользователи могут ознакомиться с доступными курсами языков и записаться на обучение.</p>
</body>
</html>