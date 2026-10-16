@extends('layouts.app')

@section('title', 'Курс: ' . ($item->title ?? '') . ' — ' . config('app.name'))

@section('content')
    <div class="card" style="border: 3px dashed #ff007f;">
        <h1 style="color: #ff007f;">🎉 Курс: {{ $item->title ?? 'Без названия' }}</h1>
        
        <p style="font-size: 1.1em; line-height: 1.6;">{{ $item->description ?? 'Подробная информация о языковом курсе.' }}</p>
        <p style="font-size: 1.05em; color: #7b1fa2; margin: 10px 0;"><strong>📚 Изучаемый язык:</strong> {{ $item->language_name ?? 'Не указан' }}</p>
        
        <div style="display: flex; gap: 20px; margin: 20px 0; background: #fff0f5; padding: 15px; border-radius: 10px;">
            @if(isset($item->price))
                <div><strong>💰 Цена:</strong> <span style="color: #2e8b57; font-size: 1.2em;">{{ $item->price }} ₸</span></div>
            @endif
            @if(isset($item->duration))
                <div><strong>⏳ Длительность:</strong> {{ $item->duration }} часов чистой магии</div>
            @endif
        </div>

        <p style="margin-top: 30px;">
            <a href="{{ route('courses.index') }}" class="badge" style="background: #ff007f; color: white; padding: 8px 15px; text-decoration: none; border-radius: 20px;">← Назад к сумасшедшему каталогу</a>
        </p>
    </div>
@endsection