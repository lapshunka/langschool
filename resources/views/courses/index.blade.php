@extends('layouts.app')

@section('title', 'Безумный каталог языков — ' . config('app.name'))

@section('content')
    <div class="card">
        <h1>🚀 Взрывные языковые курсы</h1>
        <p style="font-style: italic; color: #ff3366;">Выучи язык быстрее, чем кот съедает сосиску!</p>
        
        @forelse ($items as $id => $item)
            <div class="course-item">
                <div>
                    <span class="badge">{{ $loop->iteration }}.</span>
                    <a href="{{ route('courses.show', $id) }}" style="font-size: 1.2em; font-weight: bold; color: #ff007f; text-decoration: none;">
                        {{ $item['title'] ?? 'Курс #' . $id }}
                    </a>
                    <p style="margin: 5px 0; color: #444;">{{ $item['description'] ?? 'Интересный курс для прокачки мозгов.' }}</p>
                </div>
                
                <div style="text-align: right; min-width: 120px;">
                    @if(isset($item['price']))
                        <div style="font-weight: bold; color: #2e8b57; font-size: 1.1em;">{{ $item['price'] }} ₸</div>
                    @endif
                    @if(isset($item['duration']))
                        <div style="font-size: 0.85em; color: #666;">⏱ {{ $item['duration'] }} ч.</div>
                    @endif

                    @if(isset($item['price']) && $item['price'] > 60000)
                        <span class="badge" style="background: #ff4500; color: white;">🔥 Огненный топ</span>
                    @elseif($loop->first)
                        <span class="badge" style="background: #00fa9a; color: #000;">✨ Самый первый!</span>
                    @endif
                </div>
            </div>
        @empty
            <p style="color: red; text-align: center; font-weight: bold;">Ой-ой, каталог пуст! Все языки мира временно испарились.</p>
        @endforelse
    </div>
@endsection