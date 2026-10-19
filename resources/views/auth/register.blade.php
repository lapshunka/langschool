@extends('layouts.app')

@section('title', 'Регистрация')

@section('content')
    <div style="max-width: 500px; margin: 40px auto; background: #ffffff; padding: 30px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); border: 1px solid #e2e8f0;">
        <h1 style="margin-top: 0; margin-bottom: 25px; font-size: 1.8em; text-align: center; color: #2d3748;">Регистрация</h1>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div style="margin-bottom: 15px;">
                <label for="name" style="display: block; font-weight: 600; margin-bottom: 6px; color: #4a5568;">Имя:</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" 
                       style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e0; border-radius: 6px; box-sizing: border-box; font-size: 1em;">
                @error('name')
                    <div style="color: #e53e3e; font-size: 0.85em; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 15px;">
                <label for="email" style="display: block; font-weight: 600; margin-bottom: 6px; color: #4a5568;">E-mail:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" 
                       style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e0; border-radius: 6px; box-sizing: border-box; font-size: 1em;">
                @error('email')
                    <div style="color: #e53e3e; font-size: 0.85em; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 15px;">
                <label for="password" style="display: block; font-weight: 600; margin-bottom: 6px; color: #4a5568;">Пароль:</label>
                <input type="password" id="password" name="password" 
                       style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e0; border-radius: 6px; box-sizing: border-box; font-size: 1em;">
                @error('password')
                    <div style="color: #e53e3e; font-size: 0.85em; margin-top: 4px;">{{ $message }}</div>
        @enderror
            </div>

            <div style="margin-bottom: 25px;">
                <label for="password_confirmation" style="display: block; font-weight: 600; margin-bottom: 6px; color: #4a5568;">Повторите пароль:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" 
                       style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e0; border-radius: 6px; box-sizing: border-box; font-size: 1em;">
            </div>

            <button type="submit" style="width: 100%; background: #2b6cb0; color: white; border: none; padding: 12px; border-radius: 6px; font-weight: bold; font-size: 1em; cursor: pointer;">Зарегистрироваться</button>
        </form>
    </div>
@endsection