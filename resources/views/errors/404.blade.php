<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Страница не найдена - {{ config('app.name') }}</title>
</head>
<body>
    <h1 style="font-size: 4em; color: #d64545; margin-bottom: 0;">404</h1>
    <h2>Такой страницы не существует</h2>
    <p>К сожалению, запрашиваемая вами страница не найдена или была перемещена.</p>
    <p><a href="{{ route('home') }}">Вернуться на главную страницу</a></p>
</body>
</html>