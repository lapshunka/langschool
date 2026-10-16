@extends('layouts.app')

@section('title', 'Безумный каталог языков — ' . config('app.name'))

@section('content')
    <div class="card">
        <h1>🚀 Взрывные языковые курсы</h1>
        <p style="font-style: italic; color: #ff3366;">Выучи язык быстрее, чем кот съедает сосиску!</p>
        
        @forelse ($items as $item)
            @php
                // Определяем какой бейдж выводить для карточки
                $badgeText = null;
                if (isset($item->price) && $item->price > 60000) {
                    $badgeText = '🔥 Огненный топ';
                } elseif ($loop->first) {
                    $badgeText = '✨ Самый первый!';
                }
            @endphp

            <x-card 
                :title="$item->title ?? 'Курс'" 
                :url="route('courses.show', $item->id)" 
                :badge="$badgeText">
                
                <p style="margin: 5px 0; color: #444;">{{ $item->description ?? 'Интересный курс для прокачки мозгов.' }}</p>
                <p style="margin: 5px 0; font-size: 0.9em; color: #7b1fa2;"><strong>📚 Язык:</strong> {{ $item->language_name ?? 'Не указан' }}</p>
                
                <div style="display: flex; gap: 15px; margin-top: 10px; align-items: center;">
                    @if(isset($item->price))
                        <div style="font-weight: bold; color: #2e8b57; font-size: 1.1em;">{{ $item->price }} ₸</div>
                    @endif
                    @if(isset($item->duration))
                        <div style="font-size: 0.85em; color: #666;">⏱ {{ $item->duration }} ч.</div>
                    @endif
                </div>
            </x-card>
        @empty
            <x-alert type="warning">
                Ой-ой, каталог пуст! Все языки мира временно испарились.
            </x-alert>
        @endforelse
    </div>
@endsection