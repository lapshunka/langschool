<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Доступ запрещен - {{ config('app.name') }}</title>
</head>
<body>
    <h1 style="font-size: 4em; color: #b7791f; margin-bottom: 0;">403</h1>
    <h2>Доступ запрещён</h2>
    <p><strong>Причина:</strong> {{ $exception->getMessage() }}</p>
    <p><a href="{{ route('home') }}">Вернуться на главную страницу</a></p>
</body>
</html>