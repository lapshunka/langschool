<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Управление курсами - Админ - {{ config('app.name') }}</title>
</head>
<body>
    <nav>
        <a href="{{ route('admin.dashboard') }}">← Назад в админ-панель</a>
    </nav>
    <h1>Список всех курсов (Админ-режим)</h1>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Уровень</th>
            <th>Цена</th>
        </tr>
        @foreach ($items as $id => $item)
        <tr>
            <td>{{ $id }}</td>
            <td>{{ $item['title'] }}</td>
            <td>{{ $item['level'] }}</td>
            <td>{{ $item['price'] }} тг</td>
        </tr>
        @endforeach
    </table>
</body>
</html>