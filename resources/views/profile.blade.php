@extends('layouts.app')

@section('title', 'Мой профиль — ' . config('app.name'))

@section('content')
<div style="max-width: 900px; margin: 0 auto;">
    <h1 style="color: #2b6cb0;">👤 Личный кабинет: {{ $user->name }}</h1>
    <p style="color: #4a5568;">Email: {{ $user->email }}</p>

    <!-- БЛОК 1: УВЕДОМЛЕНИЯ ПОЛЬЗОВАТЕЛЯ -->
    <div style="margin-top: 30px; background: white; padding: 20px; border-radius: 10px; border: 1px solid #e2e8f0;">
        <h2 style="margin-top: 0; color: #2d3748; border-bottom: 2px solid #edf2f7; padding-bottom: 10px;">
            🔔 Уведомления 
            @if($user->unreadNotifications->count() > 0)
                <span style="background: #e53e3e; color: white; border-radius: 999px; padding: 2px 8px; font-size: 0.75em;">
                    {{ $user->unreadNotifications->count() }} новых
                </span>
            @endif
        </h2>

        @forelse($notifications as $notification)
            <div style="padding: 12px; margin-bottom: 8px; background: {{ $notification->read_at ? '#f7fafc' : '#ebf8ff' }}; border-left: 4px solid {{ $notification->read_at ? '#cbd5e0' : '#3182ce' }}; border-radius: 4px;">
                <div style="font-weight: 500; color: #2d3748;">
                    {{ $notification->data['text'] ?? 'Системное уведомление' }}
                </div>
                <div style="font-size: 0.8em; color: #718096; margin-top: 4px;">
                    {{ $notification->created_at->diffForHumans() }}
                </div>
            </div>
        @empty
            <p style="color: #718096; margin: 0;">У вас пока нет уведомлений.</p>
        @endforelse
    </div>

    <!-- БЛОК 2: МОИ ЗАЯВКИ НА КУРСЫ -->
    <div style="margin-top: 30px; background: white; padding: 20px; border-radius: 10px; border: 1px solid #e2e8f0;">
        <h2 style="margin-top: 0; color: #2d3748; border-bottom: 2px solid #edf2f7; padding-bottom: 10px;">
            📋 Мои заявки на курсы
        </h2>

        @forelse($bookings as $booking)
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px dashed #e2e8f0;">
                <div>
                    <strong style="font-size: 1.1em; color: #2b6cb0;">{{ $booking->course->title }}</strong>
                    <div style="font-size: 0.9em; color: #718096;">
                        Телефон: {{ $booking->phone }} | Дата: {{ $booking->created_at->format('d.m.Y H:i') }}
                    </div>
                    @if($booking->comment)
                        <div style="font-size: 0.85em; color: #4a5568; margin-top: 2px;">
                            <em>Комментарий: {{ $booking->comment }}</em>
                        </div>
                    @endif
                </div>
                <div>
                    @if($booking->status === 'new')
                        <span style="background: #fefcbf; color: #744210; padding: 4px 10px; border-radius: 20px; font-weight: bold; font-size: 0.85em;">Новая</span>
                    @elseif($booking->status === 'processed')
                        <span style="background: #c6f6d5; color: #22543d; padding: 4px 10px; border-radius: 20px; font-weight: bold; font-size: 0.85em;">Одобрена</span>
                    @elseif($booking->status === 'rejected')
                        <span style="background: #fed7d7; color: #742a2a; padding: 4px 10px; border-radius: 20px; font-weight: bold; font-size: 0.85em;">Отклонена</span>
                    @else
                        <span style="background: #edf2f7; color: #4a5568; padding: 4px 10px; border-radius: 20px; font-weight: bold; font-size: 0.85em;">{{ $booking->status }}</span>
                    @endif
                </div>
            </div>
        @empty
            <p style="color: #718096; margin: 0;">Вы еще не оставляли заявок на курсы.</p>
        @endforelse
    </div>
</div>
@endsection