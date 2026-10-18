<form method="POST" action="{{ $action }}">
    @csrf
    @isset($language)
        @method('PUT')
    @endisset

    @if ($errors->any())
        <div style="background: #fff5f5; border: 1px solid #feb2b2; color: #c53030; padding: 12px; border-radius: 8px; margin-bottom: 20px;">
            <strong>⚠️ Исправьте ошибки в форме:</strong>
        </div>
    @endif

    <div style="margin-bottom: 15px;">
        <label for="name" style="display: block; font-weight: bold; margin-bottom: 5px;">Название языка:</label>
        <input type="text" id="name" name="name" 
               value="{{ old('name', $language->name ?? '') }}" 
               style="width: 100%; padding: 8px 12px; border: 1px solid {{ $errors->has('name') ? '#e53e3e' : '#cbd5e0' }}; border-radius: 6px; box-sizing: border-box;">
        @error('name')
            <div style="color: #e53e3e; font-size: 0.85em; margin-top: 4px;">{{ $message }}</div>
        @enderror
    </div>

    <div style="display: flex; gap: 10px;">
        <button type="submit" style="background: #2b6cb0; color: white; border: none; padding: 10px 20px; border-radius: 6px; font-weight: bold; cursor: pointer;">Сохранить</button>
        <a href="{{ route('admin.languages.index') }}" style="background: #e2e8f0; color: #4a5568; padding: 10px 20px; border-radius: 6px; text-decoration: none; font-weight: bold;">Отмена</a>
    </div>
</form>