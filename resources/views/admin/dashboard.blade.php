<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Панель администратора - {{ config('app.name') }}</title>
</head>
<body>
    <nav>
        <a href="{{ route('home') }}">Главная</a> |
        <a href="{{ route('courses.index') }}">Курсы</a> |
        <a href="{{ route('rules') }}">Правила</a> |
        <a href="{{ route('admin.dashboard') }}">Админ-панель</a>
    </nav>
    <h1>Панель администратора</h1>
    <p>Добро пожаловать в закрытый раздел сотрудников языковой школы.</p>
    <ul>
        <li><a href="{{ route('admin.courses') }}">Управление курсами (список)</a></li>
        <li><a href="{{ route('admin.courses.create') }}">Добавить новый курс</a></li>
    </ul>
</body>
</html>