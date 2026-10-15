@extends('layouts.app')

@section('title', 'Сейчас закрыто — ' . config('app.name'))

@section('content')
    <div class="card" style="border-left: 4px solid #e53e3e;">
        <h1>Сейчас закрыто</h1>
        <p>Мы работаем с {{ $from }} до {{ $to }}. Пожалуйста, зайдите в рабочее время.</p>
        <p><a href="{{ route('home') }}" class="badge">На главную</a></p>
    </div>
@endsection