@extends('layouts.app')

@section('title', 'Запись — ' . config('app.name'))

@section('content')
    <div class="card">
        <h1>Записаться на пробный урок</h1>
        <form>
            <button type="button" style="background-color: #2b6cb0; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">Отправить заявку</button>
        </form>
    </div>
@endsection