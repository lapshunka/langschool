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

    <div class="card" style="overflow-x: auto;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h1>📚 Управление курсами</h1>
            <a href="{{ route('admin.courses.create') }}" style="background: #2b6cb0; color: white; padding: 10px 15px; border-radius: 6px; text-decoration: none; font-weight: bold; white-space: nowrap;">+ Добавить курс</a>
        </div>

        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px; table-layout: fixed;">
            <thead>
                <tr style="background: #f7fafc; border-bottom: 2px solid #e2e8f0; text-align: left; font-size: 0.9em;">
                    <th style="padding: 10px 8px; width: 5%;">ID</th>
                    <th style="padding: 10px 8px; width: 10%;">Обложка</th>
                    <th style="padding: 10px 8px; width: 20%;">Название</th>
                    <th style="padding: 10px 8px; width: 12%;">Язык</th>
                    <th style="padding: 10px 8px; width: 12%;">Автор</th>
                    <th style="padding: 10px 8px; width: 11%;">Цена</th>
                    <th style="padding: 10px 8px; width: 10%;">Длит.</th>
                    <th style="padding: 10px 8px; width: 10%;">Дата</th>
                    <th style="padding: 10px 8px; width: 10%; text-align: right;">Действия</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $course)
                    <tr style="border-bottom: 1px solid #e2e8f0; font-size: 0.9em;">
                        <td style="padding: 10px 8px;">{{ $course->id }}</td>
                        <td style="padding: 10px 8px;">
                            <img src="{{ $course->cover_url }}" alt="{{ $course->title }}" style="width: 60px; height: 40px; object-fit: cover; border-radius: 4px;">
                        </td>
                        <td style="padding: 10px 8px; font-weight: bold; word-break: break-word;">{{ $course->title }}</td>
                        <td style="padding: 10px 8px; word-break: break-word;">{{ $course->language->name ?? 'Не указан' }}</td>
                        <td style="padding: 10px 8px; word-break: break-word;">{{ $course->user?->name ?? '—' }}</td>
                        <td style="padding: 10px 8px; white-space: nowrap;">{{ $course->price }} ₸</td>
                        <td style="padding: 10px 8px; white-space: nowrap;">{{ $course->duration }} ч.</td>
                        <td style="padding: 10px 8px; white-space: nowrap;">{{ $course->created_at->format('d.m.Y') }}</td>
                        <td style="padding: 10px 8px; text-align: right;">
                            <div style="display: flex; gap: 6px; justify-content: flex-end; align-items: center;">
                                @can('update', $course)
                                    <a href="{{ route('admin.courses.edit', $course->id) }}" style="background: #d69e2e; color: white; padding: 4px 8px; border-radius: 4px; text-decoration: none; font-size: 0.8em;">Изм.</a>
                                @endcan
                                
                                @can('delete', $course)
                                    <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" onsubmit="return confirm('Удалить этот курс?')" style="margin: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background: #e53e3e; color: white; border: none; padding: 4px 8px; border-radius: 4px; cursor: pointer; font-size: 0.8em;">Уд.</button>
                                    </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" style="padding: 20px; text-align: center; color: #718096;">Курсов пока нет.</td>
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