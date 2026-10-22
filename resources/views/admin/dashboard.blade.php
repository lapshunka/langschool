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

        <!-- Кнопка формирования PDF в фоне (ЛР10, Задание 4) -->
        <div style="margin-top: 25px; padding-top: 15px; border-top: 1px solid #e2e8f0;">
            <form action="{{ route('admin.exports.generate') }}" method="POST">
                @csrf
                <button type="submit" style="background: #3182ce; color: white; border: none; padding: 10px 15px; border-radius: 6px; cursor: pointer; font-weight: bold;">
                    📄 Сформировать PDF в фоне
                </button>
            </form>
        </div>
    </div>
@endsection