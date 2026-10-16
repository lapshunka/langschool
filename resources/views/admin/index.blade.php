@extends('layouts.admin')

@section('title', 'Управление курсами — Админ')

@section('content')
    <div class="card">
        <h1>Управление курсами</h1>
        <table style="width: 100%; border-collapse: collapse; margin-top: 15px;">
            <thead>
                <tr style="background-color: #edf2f7; text-align: left;">
                    <th style="padding: 10px; border: 1px solid #cbd5e0;">№</th>
                    <th style="padding: 10px; border: 1px solid #cbd5e0;">Название курса</th>
                    <th style="padding: 10px; border: 1px solid #cbd5e0;">Статус</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $id => $item)
                    <tr>
                        <td style="padding: 10px; border: 1px solid #cbd5e0;">{{ $loop->iteration }}</td>
                        <td style="padding: 10px; border: 1px solid #cbd5e0;">{{ $item['title'] ?? 'Курс #' . $id }}</td>
                        <td style="padding: 10px; border: 1px solid #cbd5e0;">
                            @if($loop->first)
                                <x-badge>новая</x-badge>
                            @else
                                активна
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection