@extends('layouts.app')

@section('title', 'Страница не найдена — 404')

@section('content')
    <div class="card">
        <h1>Ошибка 404</h1>
        <x-alert type="warning">
            Запрашиваемая страница или курс не найдены в нашей языковой школе.
        </x-alert>
        <p style="margin-top: 20px;"><a href="{{ route('home') }}" class="badge">← Вернуться на главную</a></p>
    </div>
@endsection