@extends('layouts.app')

@section('title', 'Главная — ' . config('app.name'))

@section('content')
    <div class="card" style="margin-bottom: 25px;">
        <h1>{{ config('app.name') }}</h1>
        <p>Добро пожаловать на официальный сайт нашей языковой школы! Изучайте английский, немецкий и другие языки с профессиональными преподавателями.</p>
    </div>

    <h2>🔥 Популярные курсы</h2>

    <!-- Первая карточка с дополнительным классом card-wide -->
    <x-card title="Английский для начинающих" :url="route('courses.index')" badge="Хит" class="card-wide">
        Идеальный старт для тех, кто хочет заговорить с нуля.
    </x-card>

    <x-card title="Разговорный немецкий" :url="route('courses.index')" badge="Новинка">
        Живая практика языка для путешествий и карьеры.
    </x-card>

    <x-card title="Интенсивный испанский" :url="route('courses.index')">
        Погружение в языковую среду в кратчайшие сроки.
    </x-card>
@endsection