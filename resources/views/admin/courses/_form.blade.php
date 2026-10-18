<form method="POST" action="{{ $action }}">
    @csrf
    @isset($course)
        @method('PUT')
    @endisset

    <!-- Общий блок ошибок (Задание 5) -->
    @if ($errors->any())
        <div style="background: #fff5f5; border: 1px solid #feb2b2; color: #c53030; padding: 12px; border-radius: 8px; margin-bottom: 20px;">
            <strong>⚠️ Исправьте ошибки в форме ({{ $errors->count() }}):</strong>
        </div>
    @endif

    <!-- Поле: Название -->
    <div style="margin-bottom: 15px;">
        <label for="title" style="display: block; font-weight: bold; margin-bottom: 5px;">Название курса:</label>
        <input type="text" id="title" name="title" 
               value="{{ old('title', $course->title ?? '') }}" 
               @class(['invalid' => $errors->has('title')])
               style="width: 100%; padding: 8px 12px; border: 1px solid {{ $errors->has('title') ? '#e53e3e' : '#cbd5e0' }}; border-radius: 6px; box-sizing: border-box;">
        @error('title')
            <div style="color: #e53e3e; font-size: 0.85em; margin-top: 4px;">{{ $message }}</div>
        @enderror
    </div>

    <!-- Поле: Выпадающий список "Язык" -->
    <div style="margin-bottom: 15px;">
        <label for="language_id" style="display: block; font-weight: bold; margin-bottom: 5px;">Язык:</label>
        <select id="language_id" name="language_id" 
                style="width: 100%; padding: 8px 12px; border: 1px solid {{ $errors->has('language_id') ? '#e53e3e' : '#cbd5e0' }}; border-radius: 6px; background: #fff;">
            <option value="">-- Выберите язык --</option>
            @foreach ($languages as $language)
                <option value="{{ $language->id }}" @selected(old('language_id', $course->language_id ?? '') == $language->id)>
                    {{ $language->name }}
                </option>
            @endforeach
        </select>
        @error('language_id')
            <div style="color: #e53e3e; font-size: 0.85em; margin-top: 4px;">{{ $message }}</div>
        @enderror
    </div>

    <!-- Поле: Текстовое описание (Textarea) -->
    <div style="margin-bottom: 15px;">
        <label for="description" style="display: block; font-weight: bold; margin-bottom: 5px;">Описание:</label>
        <textarea id="description" name="description" rows="4" 
                  style="width: 100%; padding: 8px 12px; border: 1px solid {{ $errors->has('description') ? '#e53e3e' : '#cbd5e0' }}; border-radius: 6px; box-sizing: border-box;">{{ old('description', $course->description ?? '') }}</textarea>
        @error('description')
            <div style="color: #e53e3e; font-size: 0.85em; margin-top: 4px;">{{ $message }}</div>
        @enderror
    </div>

    <!-- Поле: Цена -->
    <div style="margin-bottom: 15px;">
        <label for="price" style="display: block; font-weight: bold; margin-bottom: 5px;">Цена (₸):</label>
        <input type="number" step="0.01" id="price" name="price" 
               value="{{ old('price', $course->price ?? '') }}" 
               style="width: 100%; padding: 8px 12px; border: 1px solid {{ $errors->has('price') ? '#e53e3e' : '#cbd5e0' }}; border-radius: 6px; box-sizing: border-box;">
        @error('price')
            <div style="color: #e53e3e; font-size: 0.85em; margin-top: 4px;">{{ $message }}</div>
        @enderror
    </div>

    <!-- Поле: Длительность -->
    <div style="margin-bottom: 15px;">
        <label for="duration" style="display: block; font-weight: bold; margin-bottom: 5px;">Длительность (в часах):</label>
        <input type="number" id="duration" name="duration" 
               value="{{ old('duration', $course->duration ?? '') }}" 
               style="width: 100%; padding: 8px 12px; border: 1px solid {{ $errors->has('duration') ? '#e53e3e' : '#cbd5e0' }}; border-radius: 6px; box-sizing: border-box;">
        @error('duration')
            <div style="color: #e53e3e; font-size: 0.85em; margin-top: 4px;">{{ $message }}</div>
        @enderror
    </div>

    <!-- Чекбокс: Активен -->
    <div style="margin-bottom: 20px;">
        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
            <input type="checkbox" name="is_active" value="1" 
                   @checked(old('is_active', $course->is_active ?? true))> 
            <span style="font-weight: bold;">Отображать курс в каталоге</span>
        </label>
    </div>

    <div style="display: flex; gap: 10px;">
        <button type="submit" style="background: #2b6cb0; color: white; border: none; padding: 10px 20px; border-radius: 6px; font-weight: bold; cursor: pointer;">Сохранить</button>
        <a href="{{ route('admin.courses.index') }}" style="background: #e2e8f0; color: #4a5568; padding: 10px 20px; border-radius: 6px; text-decoration: none; font-weight: bold;">Отмена</a>
    </div>
</form>