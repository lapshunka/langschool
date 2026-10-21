@extends('layouts.app')

@section('title', 'Курс: ' . $course->title . ' — ' . config('app.name'))

@section('content')
    <div class="card" style="border: 3px dashed #ff007f; overflow: hidden;">
        <!-- Крупное изображение (Задание 3) -->
        <div style="margin: -20px -20px 20px -20px;">
            <img src="{{ $course->cover_url }}" alt="{{ $course->title }}" style="width: 100%; height: 320px; object-fit: cover;">
        </div>

        <h1 style="color: #ff007f;">🎉 Курс: {{ $course->title }}</h1>
        
        @if (session('success'))
            <div style="margin: 15px 0; padding: 15px; background: #def7ec; color: #03543f; border: 1px solid #84e1bc; border-radius: 8px; font-weight: bold;">
                {{ session('success') }}
            </div>
        @endif

        <p style="font-size: 1.1em; line-height: 1.6;">{{ $course->description }}</p>
        
        <!-- Ссылка на страницу языка -->
        <p style="font-size: 1.05em; color: #7b1fa2; margin: 10px 0;">
            <strong>📚 Изучаемый язык:</strong> 
            <a href="{{ route('languages.show', $course->language->id) }}" style="color: #7b1fa2; font-weight: bold;">
                {{ $course->language->name }}
            </a>
        </p>
        
        <div style="display: flex; gap: 20px; margin: 20px 0; background: #fff0f5; padding: 15px; border-radius: 10px; flex-wrap: wrap;">
            <div><strong>💰 Цена:</strong> <span style="color: #2e8b57; font-size: 1.2em;">{{ $course->price }} ₸</span></div>
            <div><strong>⏳ Длительность:</strong> {{ $course->duration }} часов чистой магии</div>
        </div>

        <!-- Блок формы записи на пробный урок (ЛР9, Задание 2) -->
        <div style="margin: 25px 0; padding: 20px; background: #f0fdf4; border-radius: 8px; border: 1px solid #bbf7d0;">
            <h3 style="margin-top: 0; color: #166534;">🎯 Записаться на пробный урок</h3>
            
            @auth
                <form action="{{ route('courses.bookings.store', $course->id) }}" method="POST">
                    @csrf
                    <div style="margin-bottom: 12px;">
                        <label for="phone" style="display: block; font-weight: bold; margin-bottom: 5px; color: #166534;">Телефон (+7XXXXXXXXXX):</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" placeholder="+77011234567" style="width: 100%; padding: 8px; border: 1px solid #cbd5e0; border-radius: 4px; box-sizing: border-box;">
                        @error('phone')
                            <div style="color: #e53e3e; font-size: 0.85em; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div style="margin-bottom: 12px;">
                        <label for="comment" style="display: block; font-weight: bold; margin-bottom: 5px; color: #166534;">Комментарий:</label>
                        <textarea id="comment" name="comment" rows="3" placeholder="Удобное время или вопросы..." style="width: 100%; padding: 8px; border: 1px solid #cbd5e0; border-radius: 4px; box-sizing: border-box;">{{ old('comment') }}</textarea>
                        @error('comment')
                            <div style="color: #e53e3e; font-size: 0.85em; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" style="background: #16a34a; color: white; border: none; padding: 10px 18px; border-radius: 6px; font-weight: bold; cursor: pointer;">
                        Отправить заявку
                    </button>
                </form>
            @else
                <p style="color: #718096; margin-bottom: 10px;">🔒 Записаться на пробный урок могут только зарегистрированные пользователи.</p>
                <div>
                    <a href="{{ route('login') }}" style="color: #2b6cb0; font-weight: bold; text-decoration: underline;">Войдите в систему</a> или <a href="{{ route('register') }}" style="color: #2b6cb0; font-weight: bold; text-decoration: underline;">зарегистрируйтесь</a>, чтобы оставить заявку.
                </div>
            @endauth
        </div>

        <!-- Блок закрытого PDF-документа (Задание 4 из ЛР8) -->
        <div style="margin: 25px 0; padding: 20px; background: #f7fafc; border-radius: 8px; border: 1px solid #e2e8f0;">
            <h3 style="margin-top: 0; color: #2d3748;">📄 Программа курса (PDF)</h3>
            
            @auth
                @if ($course->attachment)
                    <p>Документ доступен вам как авторизованному пользователю:</p>
                    <a href="{{ route('courses.attachment', $course->id) }}" style="display: inline-block; background: #2b6cb0; color: white; padding: 10px 20px; border-radius: 6px; text-decoration: none; font-weight: bold;">
                        📥 Скачать программу курса
                    </a>
                @else
                    <p style="color: #718096; margin: 0;">Для этого курса пока не загружена программа в формате PDF.</p>
                @endif
            @else
                <p style="color: #718096; margin-bottom: 10px;">🔒 Программа курса доступна только зарегистрированным пользователям.</p>
                <div>
                    <a href="{{ route('login') }}" style="color: #2b6cb0; font-weight: bold; text-decoration: underline;">Войдите в систему</a> или <a href="{{ route('register') }}" style="color: #2b6cb0; font-weight: bold; text-decoration: underline;">зарегистрируйтесь</a>, чтобы скачать файл.
                </div>
            @endauth
        </div>

        <!-- Блок QR-кода для мобильных устройств (Задание 7 из ЛР8) -->
        <div style="margin: 25px 0; padding: 20px; background: #fdf2f8; border-radius: 8px; border: 1px solid #fbb6ce; display: flex; align-items: center; gap: 20px; flex-wrap: wrap;">
            <div style="background: white; padding: 10px; border-radius: 8px; border: 1px solid #e2e8f0; display: inline-block;">
                {!! QrCode::size(110)->generate(route('courses.show', $course->id)) !!}
            </div>
            <div>
                <h4 style="margin: 0 0 5px 0; color: #db2777;">📱 Быстрый доступ</h4>
                <p style="margin: 0; font-size: 0.9em; color: #4a5568;">Сканируйте QR-код камерой смартфона, чтобы открыть этот курс на мобильном устройстве.</p>
            </div>
        </div>

        <!-- Блок «Ещё из этой категории» -->
        <div style="margin-top: 30px; border-top: 2px solid #eee; padding-top: 20px;">
            <h3 style="color: #333; margin-bottom: 15px;">📌 Ещё из категории «{{ $course->language->name }}»:</h3>
            <div style="display: grid; gap: 10px;">
                @forelse($relatedCourses as $related)
                    <div style="background: #fafafa; padding: 10px 15px; border-radius: 8px; display: flex; justify-content: space-between; align-items: center;">
                        <a href="{{ route('courses.show', $related->id) }}" style="text-decoration: none; color: #2b6cb0; font-weight: 500;">
                            {{ $related->title }}
                        </a>
                        <span style="color: #2e8b57; font-size: 0.9em; font-weight: bold;">{{ $related->price }} ₸</span>
                    </div>
                @empty
                    <p style="color: #666; font-size: 0.9em;">Других курсов в этой категории пока нет.</p>
                @endforelse
            </div>
        </div>

        <p style="margin-top: 30px;">
            <a href="{{ route('courses.index') }}" class="badge" style="background: #ff007f; color: white; padding: 8px 15px; text-decoration: none; border-radius: 20px;">← Назад к каталогу</a>
        </p>
    </div>
@endsection