<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Сейчас закрыто - {{ config('app.name') }}</title>
</head>
<body>
    <h1>Сейчас закрыто</h1>
    <p>Мы работаем с {{ $from }} до {{ $to }}. Пожалуйста, зайдите в рабочее время.</p>
    <p><a href="{{ route('home') }}">На главную</a></p>
</body>
</html>