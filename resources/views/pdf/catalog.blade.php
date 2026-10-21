<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: "DejaVu Sans", sans-serif; font-size: 12px; color: #2d3748; }
        h1 { font-size: 16px; margin-bottom: 5px; color: #1a202c; }
        .date { font-size: 10px; color: #718096; margin-bottom: 15px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #cbd5e0; padding: 6px 8px; text-align: left; vertical-align: middle; }
        th { background-color: #edf2f7; color: #2d3748; font-weight: bold; }
        .thumb { width: 35px; height: 35px; object-fit: cover; border-radius: 4px; }
        .total { margin-top: 15px; font-weight: bold; font-size: 13px; }
    </style>
</head>
<body>
    <h1>{{ config('app.name') }}: каталог курсов</h1>
    <div class="date">Дата формирования: {{ now()->format('d.m.Y H:i') }}</div>
    
    <table>
        <thead>
            <tr>
                <th style="width: 30px;">№</th>
                <th style="width: 45px;">Обложка</th>
                <th>Название курса</th>
                <th>Язык</th>
                <th>Цена</th>
                <th>Длительность</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($courses as $course)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if ($course->cover && file_exists(public_path('storage/' . $course->cover)))
                            <img src="{{ public_path('storage/' . $course->cover) }}" class="thumb">
                        @else
                            <span style="color: #a0aec0; font-size: 10px;">нет</span>
                        @endif
                    </td>
                    <td><strong>{{ $course->title }}</strong></td>
                    <td>{{ $course->language->name ?? 'Не указан' }}</td>
                    <td>{{ number_format($course->price, 2, '.', ' ') }} ₸</td>
                    <td>{{ $course->duration }} ч.</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        Всего курсов в отчете: {{ $courses->count() }}
    </div>
</body>
</html>