@extends('layouts.app')

@section('title', 'Курс: ' . $course->title . ' — ' . config('app.name'))

@section('content')
    <div class="card" style="border: 3px dashed #ff007f;">
        <h1 style="color: #ff007f;">🎉 Курс: {{ $course->title }}</h1>
        
        <p style="font-size: 1.1em; line-height: 1.6;">{{ $course->description }}</p>
        
        <!-- Ссылка на страницу языка (Задание 4) -->
        <p style="font-size: 1.05em; color: #7b1fa2; margin: 10px 0;">
            <strong>📚 Изучаемый язык:</strong> 
            <a href="{{ route('languages.show', $course->language->id) }}" style="color: #7b1fa2; font-weight: bold;">
                {{ $course->language->name }}
            </a>
        </p>
        
        <div style="display: flex; gap: 20px; margin: 20px 0; background: #fff0f5; padding: 15px; border-radius: 10px;">
            <div><strong>💰 Цена:</strong> <span style="color: #2e8b57; font-size: 1.2em;">{{ $course->price }} ₸</span></div>
            <div><strong>⏳ Длительность:</strong> {{ $course->duration }} часов чистой магии</div>
        </div>

        <!-- Блок «Ещё из этой категории» -->
        <div style="margin-top: 30px; border-top: 2px solid #eee; padding-top: 20px;">
            <h3 style="color: #333; margin-bottom: 15px;">📌 Ещё из категории «{{ $course->language->name }}»:</h3>
            <div style="display: grid; gap: 10px;">
                @forelse($relatedCourses as $related)
                    <div style="background: #fafafa; padding: 10px 15px; border-radius: 8px; display: flex; justify-content: space-between; align-items: center;">
                        <a href="{{ route('courses.show', $related->id) }}" style="text-decoration: none; color: #2b6cb0; font-weight: 500;">
                            {{ $related->title }}
                        </a>
                        <span style="color: #2e8b57; font-size: 0.9em; font-weight: bold;">{{ $related->price }} ₸</span>
                    </div>
                @empty
                    <p style="color: #666; font-size: 0.9em;">Других курсов в этой категории пока нет.</p>
                @endforelse
            </div>
        </div>

        <p style="margin-top: 30px;">
            <a href="{{ route('courses.index') }}" class="badge" style="background: #ff007f; color: white; padding: 8px 15px; text-decoration: none; border-radius: 20px;">← Назад к каталогу</a>
        </p>
    </div>
@endsection