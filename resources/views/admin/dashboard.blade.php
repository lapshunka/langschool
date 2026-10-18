@extends('layouts.admin')

@section('title', 'Панель администратора')

@section('content')
    <div class="card">
        <h1>Панель администратора</h1>
        <p>Добро пожаловать в закрытый раздел сотрудников языковой школы.</p>
        <ul style="margin-top: 15px; line-height: 1.8;">
            <li><a href="{{ route('admin.courses.index') }}">Управление курсами (список)</a></li>
            <li><a href="{{ route('admin.courses.create') }}">Добавить новый курс</a></li>
            <li style="margin-top: 10px;"><a href="{{ route('admin.languages.index') }}">Управление языками (список)</a></li>
            <li><a href="{{ route('admin.languages.create') }}">Добавить новый язык</a></li>
        </ul>
    </div>
@endsection