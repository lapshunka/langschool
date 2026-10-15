@extends('layouts.admin')

@section('title', 'Добавить курс — Админ')

@section('content')
    <div class="card">
        <h1>Добавление нового курса</h1>
        <p>Здесь будет форма добавления записи (пока без обработки).</p>
        <p style="margin-top: 20px;"><a href="{{ route('admin.dashboard') }}">← Назад в админ-панель</a></p>
    </div>
@endsection