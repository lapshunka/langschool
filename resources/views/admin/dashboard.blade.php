@extends('layouts.admin')

@section('title', 'Панель администратора')

@section('content')
    <div class="card">
        <h1>Панель администратора</h1>
        <p>Добро пожаловать в закрытый раздел сотрудников языковой школы.</p>
        <ul style="margin-top: 15px; line-height: 1.8;">
            <li><a href="{{ route('admin.courses') }}">Управление курсами (список)</a></li>
            <li><a href="{{ route('admin.courses.create') }}">Добавить новый курс</a></li>
        </ul>
    </div>
@endsection