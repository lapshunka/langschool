@extends('layouts.app')

@section('title', 'О проекте — ' . config('app.name'))

@section('content')
    <div class="card">
        <h1>О проекте</h1>
        <p><strong>Разработчик:</strong> {{ $fio }}</p>
        <p><strong>Группа:</strong> {{ $group }}</p>
        <p>Проект «Языковая школа» разработан в рамках лабораторных работ по производственному обучению. Здесь пользователи могут ознакомиться с доступными курсами языков и записаться на обучение.</p>
    </div>
@endsection