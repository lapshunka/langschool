@extends('layouts.app')

@section('title', 'Вход в систему')

@section('content')
    <div style="max-width: 500px; margin: 40px auto; background: #ffffff; padding: 30px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); border: 1px solid #e2e8f0;">
        <h1 style="margin-top: 0; margin-bottom: 25px; font-size: 1.8em; text-align: center; color: #2d3748;">Вход в систему</h1>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div style="margin-bottom: 15px;">
                <label for="email" style="display: block; font-weight: 600; margin-bottom: 6px; color: #4a5568;">E-mail:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" 
                       style="width: 100%; padding: 10px 12px; border: 1px solid {{ $errors->has('email') ? '#e53e3e' : '#cbd5e0' }}; border-radius: 6px; box-sizing: border-box; font-size: 1em;">
                @error('email')
                    <div style="color: #e53e3e; font-size: 0.85em; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 15px;">
                <label for="password" style="display: block; font-weight: 600; margin-bottom: 6px; color: #4a5568;">Пароль:</label>
                <input type="password" id="password" name="password" 
                       style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e0; border-radius: 6px; box-sizing: border-box; font-size: 1em;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; color: #4a5568;">
                    <input type="checkbox" name="remember" style="width: 16px; height: 16px;"> Запомнить меня
                </label>
            </div>

            <button type="submit" style="width: 100%; background: #2b6cb0; color: white; border: none; padding: 12px; border-radius: 6px; font-weight: bold; font-size: 1em; cursor: pointer;">Войти</button>
        </form>
    </div>
@endsection