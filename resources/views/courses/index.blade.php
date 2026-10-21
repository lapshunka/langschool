@extends('layouts.app')

@section('title', 'Безумный каталог языков — ' . config('app.name'))

@section('content')
    <style>
        /* Изолированные стили только для пагинации (не трогают шапку) */
        .pagination-wrapper nav svg {
            width: 16px !important;
            height: 16px !important;
            display: inline-block;
            vertical-align: middle;
        }
        .pagination-wrapper nav {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
        }
        .pagination-wrapper nav p.text-sm {
            color: #718096;
            font-size: 0.9em;
            margin: 0;
        }
        .pagination-wrapper nav div:first-child {
            display: none;
        }
    </style>

    <div class="card">
        <h1>🚀 Взрывные языковые курсы</h1>
        <p style="font-style: italic; color: #ff3366;">Выучи язык быстрее, чем кот съедает сосиску!</p>
        
        <!-- Форма поиска, фильтрации и сортировки (Задание 5) -->
        <form method="GET" action="{{ route('courses.index') }}" style="background: #edf2f7; padding: 15px; border-radius: 10px; margin: 20px 0; display: flex; flex-wrap: wrap; gap: 15px; align-items: flex-end;">
            
            <!-- Поле поиска -->
            <div style="flex: 1; min-width: 200px;">
                <label for="q" style="display: block; font-size: 0.85em; font-weight: bold; margin-bottom: 5px; color: #4a5568;">Поиск по названию/описанию:</label>
                <input type="text" id="q" name="q" value="{{ request('q') }}" placeholder="Например: Деловой..." style="width: 100%; padding: 8px 12px; border: 1px solid #cbd5e0; border-radius: 6px; box-sizing: border-box;">
            </div>

            <!-- Выпадающий список языков -->
            <div style="min-width: 160px;">
                <label for="language" style="display: block; font-size: 0.85em; font-weight: bold; margin-bottom: 5px; color: #4a5568;">Язык:</label>
                <select id="language" name="language" style="width: 100%; padding: 8px 12px; border: 1px solid #cbd5e0; border-radius: 6px; background: #fff;">
                    <option value="">Все языки</option>
                    @foreach($languages as $lang)
                        <option value="{{ $lang->id }}" @selected(request('language') == $lang->id)>
                            {{ $lang->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Сортировка -->
            <div style="min-width: 160px;">
                <label for="sort" style="display: block; font-size: 0.85em; font-weight: bold; margin-bottom: 5px; color: #4a5568;">Сортировка:</label>
                <select id="sort" name="sort" style="width: 100%; padding: 8px 12px; border: 1px solid #cbd5e0; border-radius: 6px; background: #fff;">
                    <option value="title" @selected(request('sort') == 'title')>По названию</option>
                    <option value="price" @selected(request('sort') == 'price')>По цене</option>
                    <option value="duration" @selected(request('sort') == 'duration')>По длительности</option>
                </select>
            </div>

            <!-- Кнопки -->
            <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                <button type="submit" style="background: #2b6cb0; color: white; border: none; padding: 9px 16px; border-radius: 6px; font-weight: bold; cursor: pointer;">Найти</button>
                <a href="{{ route('courses.index') }}" style="background: #e2e8f0; color: #4a5568; border: none; padding: 9px 16px; border-radius: 6px; text-decoration: none; font-weight: bold; display: inline-flex; align-items: center;">Сбросить</a>
                <!-- Кнопка скачивания PDF (Задание 6) -->
                <a href="{{ route('courses.pdf', request()->query()) }}" style="background: #2f9e66; color: white; padding: 9px 16px; border-radius: 6px; text-decoration: none; font-weight: bold; display: inline-flex; align-items: center;">📄 Скачать PDF</a>
            </div>
        </form>

        <!-- Блок бокового меню языков с количеством (Задание 4) -->
        <div style="background: #f7fafc; padding: 15px; border-radius: 10px; margin-bottom: 20px; border: 1px solid #e2e8f0;">
            <h3 style="margin-top: 0; color: #2d3748; font-size: 1.1em;">📂 Языки обучения:</h3>
            <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-wrap: wrap; gap: 10px;">
                @foreach($languages as $lang)
                    <li>
                        <a href="{{ route('languages.show', $lang->id) }}" style="background: #fff; border: 1px solid #cbd5e0; padding: 6px 12px; border-radius: 20px; text-decoration: none; color: #2b6cb0; display: inline-block; font-size: 0.9em;">
                            {{ $lang->name }} 
                            <span style="background: #ebf8ff; color: #2b6cb0; padding: 2px 6px; border-radius: 10px; font-weight: bold; font-size: 0.85em;">
                                {{ $lang->courses_count }}
                            </span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        @forelse ($items as $item)
            @php
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
                :image="$item->cover_url"
                :badge="$badgeText">
                
                <p style="margin: 5px 0; color: #444;">{{ $item->description ?? 'Интересный курс для прокачки мозгов.' }}</p>
                
                <p style="margin: 5px 0; font-size: 0.9em; color: #7b1fa2;">
                    <strong>📚 Язык:</strong> 
                    <a href="{{ route('languages.show', $item->language->id) }}" style="color: #7b1fa2; text-decoration: none;">
                        {{ $item->language->name ?? 'Не указан' }}
                    </a>
                </p>
                
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
                @if(request('q'))
                    По запросу «{{ request('q') }}» ничего не найдено.
                @else
                    Ой-ой, каталог пуст! Все языки мира временно испарились.
                @endif
            </x-alert>
        @endforelse

        <!-- Блок пагинации (Задание 6) -->
        <div class="pagination-wrapper" style="margin-top: 25px; display: flex; justify-content: center;">
            {{ $items->links() }}
        </div>
    </div>
@endsection