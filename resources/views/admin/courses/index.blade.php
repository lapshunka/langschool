@extends('layouts.admin')

@section('title', 'Управление курсами')

@section('content')
    <style>
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
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h1>📚 Управление курсами</h1>
            <a href="{{ route('admin.courses.create') }}" style="background: #2b6cb0; color: white; padding: 10px 15px; border-radius: 6px; text-decoration: none; font-weight: bold;">+ Добавить курс</a>
        </div>

        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
            <thead>
                <tr style="background: #f7fafc; border-bottom: 2px solid #e2e8f0; text-align: left;">
                    <th style="padding: 10px;">ID</th>
                    <th style="padding: 10px;">Название</th>
                    <th style="padding: 10px;">Язык</th>
                    <th style="padding: 10px;">Цена</th>
                    <th style="padding: 10px;">Длительность</th>
                    <th style="padding: 10px;">Дата создания</th>
                    <th style="padding: 10px; text-align: right;">Действия</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $course)
                    <tr style="border-bottom: 1px solid #e2e8f0;">
                        <td style="padding: 10px;">{{ $course->id }}</td>
                        <td style="padding: 10px; font-weight: bold;">{{ $course->title }}</td>
                        <td style="padding: 10px;">{{ $course->language->name ?? 'Не указан' }}</td>
                        <td style="padding: 10px;">{{ $course->price }} ₸</td>
                        <td style="padding: 10px;">{{ $course->duration }} ч.</td>
                        <td style="padding: 10px;">{{ $course->created_at->format('d.m.Y') }}</td>
                        <td style="padding: 10px; text-align: right; display: flex; gap: 8px; justify-content: flex-end; align-items: center;">
                            <a href="{{ route('admin.courses.edit', $course->id) }}" style="background: #d69e2e; color: white; padding: 5px 10px; border-radius: 4px; text-decoration: none; font-size: 0.85em;">Изменить</a>
                            
                            <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" onsubmit="return confirm('Удалить этот курс?')" style="margin: 0;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background: #e53e3e; color: white; border: none; padding: 6px 10px; border-radius: 4px; cursor: pointer; font-size: 0.85em;">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="padding: 20px; text-align: center; color: #718096;">Курсов пока нет.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Блок пагинации -->
        <div class="pagination-wrapper" style="margin-top: 25px; display: flex; justify-content: center;">
            {{ $items->links() }}
        </div>
    </div>
@endsection