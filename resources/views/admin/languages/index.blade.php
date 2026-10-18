@extends('layouts.admin')

@section('title', 'Управление языками')

@section('content')
    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h1>📂 Управление языками обучения</h1>
            <a href="{{ route('admin.languages.create') }}" style="background: #2b6cb0; color: white; padding: 10px 15px; border-radius: 6px; text-decoration: none; font-weight: bold;">+ Добавить язык</a>
        </div>

        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
            <thead>
                <tr style="background: #f7fafc; border-bottom: 2px solid #e2e8f0; text-align: left;">
                    <th style="padding: 10px;">ID</th>
                    <th style="padding: 10px;">Название языка</th>
                    <th style="padding: 10px;">Кол-во курсов</th>
                    <th style="padding: 10px;">Дата создания</th>
                    <th style="padding: 10px; text-align: right;">Действия</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $language)
                    <tr style="border-bottom: 1px solid #e2e8f0;">
                        <td style="padding: 10px;">{{ $language->id }}</td>
                        <td style="padding: 10px; font-weight: bold;">{{ $language->name }}</td>
                        <td style="padding: 10px;">{{ $language->courses_count }}</td>
                        <td style="padding: 10px;">{{ $language->created_at->format('d.m.Y') }}</td>
                        <td style="padding: 10px; text-align: right; display: flex; gap: 8px; justify-content: flex-end; align-items: center;">
                            <a href="{{ route('admin.languages.edit', $language->id) }}" style="background: #d69e2e; color: white; padding: 5px 10px; border-radius: 4px; text-decoration: none; font-size: 0.85em;">Изменить</a>
                            
                            <form action="{{ route('admin.languages.destroy', $language->id) }}" method="POST" onsubmit="return confirm('Удалить этот язык?')" style="margin: 0;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background: #e53e3e; color: white; border: none; padding: 6px 10px; border-radius: 4px; cursor: pointer; font-size: 0.85em;">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="padding: 20px; text-align: center; color: #718096;">Языков пока нет.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top: 25px; display: flex; justify-content: center;">
            {{ $items->links() }}
        </div>
    </div>
@endsection