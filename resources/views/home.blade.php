@extends('layouts.app')

@section('title', 'Главная — ' . config('app.name'))

@section('content')
    <div class="card">
        <h1>{{ config('app.name') }}</h1>
        <p>Добро пожаловать на официальный сайт нашей языковой школы! Изучайте английский, немецкий и другие языки с профессиональными преподавателями.</p>
        <p>Сегодня: {{ now()->format('d.m.Y') }}</p>
    </div>
@endsection