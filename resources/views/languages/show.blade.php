@extends('layouts.app')

@section('title', 'Язык: ' . $language->name . ' — ' . config('app.name'))

@section('content')
    <div class="card">
        <h1>📚 Язык: {{ $language->name }}</h1>
        <p style="font-size: 1.1em; color: #555; line-height: 1.6;">{{ $language->description }}</p>

        <h2 style="margin-top: 30px; border-bottom: 2px solid #eee; padding-bottom: 10px;">Доступные курсы:</h2>

        <div style="margin-top: 20px;">
            @forelse ($courses as $course)
                <x-card :title="$course->title" :url="route('courses.show', $course->id)">
                    <p style="margin: 5px 0; color: #444;">{{ $course->description }}</p>
                    <div style="display: flex; gap: 15px; margin-top: 10px; align-items: center;">
                        <div style="font-weight: bold; color: #2e8b57; font-size: 1.1em;">{{ $course->price }} ₸</div>
                        <div style="font-size: 0.85em; color: #666;">⏱ {{ $course->duration }} ч.</div>
                    </div>
                </x-card>
            @empty
                <x-alert type="warning">
                    Для этого языка пока нет активных курсов.
                </x-alert>
            @endforelse
        </div>

        <p style="margin-top: 30px;">
            <a href="{{ route('courses.index') }}" class="badge" style="background: #2b6cb0; color: white; padding: 8px 15px; text-decoration: none; border-radius: 20px;">← Назад к каталогу курсов</a>
        </p>
    </div>
@endsection