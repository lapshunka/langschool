@extends('layouts.app')

@section('title', 'Доступ запрещен — 403')

@section('content')
    <div class="card">
        <h1>Ошибка 403</h1>
        <x-alert type="error">
            У вас нет прав для просмотра этого секретного раздела.
        </x-alert>
        <p style="margin-top: 20px;"><a href="{{ route('home') }}" class="badge">← Вернуться на главную</a></p>
    </div>
@endsection