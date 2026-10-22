@extends('layouts.admin')

@section('title', 'Уведомления администратора')

@section('content')
    <div class="card" style="padding: 20px; background: white; border-radius: 8px; border: 1px solid #e2e8f0;">
        <h1 style="color: #2b6cb0; margin-top: 0;">🔔 Уведомления администратора</h1>

        @if(session('success'))
            <div style="background: #c6f6d5; color: #22543d; padding: 10px; border-radius: 6px; margin-bottom: 15px;">
                {{ session('success') }}
            </div>
        @endif

        @if(auth()->user()->unreadNotifications->count() > 0)
            <form action="{{ route('admin.notifications.read') }}" method="POST" style="margin-bottom: 15px;">
                @csrf
                <button type="submit" style="background: #3182ce; color: white; border: none; padding: 8px 14px; border-radius: 6px; cursor: pointer; font-weight: bold;">
                    ✓ Отметить все как прочитанные
                </button>
            </form>
        @endif

        <div style="margin-top: 15px;">
            @forelse($notifications as $notification)
                <div style="padding: 12px 15px; margin-bottom: 10px; background: {{ $notification->read_at ? '#f7fafc' : '#ebf8ff' }}; border-left: 4px solid {{ $notification->read_at ? '#cbd5e0' : '#3182ce' }}; border-radius: 4px;">
                    <div style="font-weight: 500; color: #2d3748; font-size: 1.05em;">
                        {{ $notification->data['text'] ?? 'Системное уведомление' }}
                        
                        {{-- Если в уведомлении есть ссылка на скачивание PDF (Задание 4) --}}
                        @if(isset($notification->data['url']))
                            <div style="margin-top: 6px;">
                                <a href="{{ $notification->data['url'] }}" style="display: inline-block; background: #38a169; color: white; padding: 4px 10px; border-radius: 4px; text-decoration: none; font-size: 0.9em; font-weight: bold;">
                                    📥 Скачать PDF-каталог
                                </a>
                            </div>
                        @endif
                    </div>
                    <div style="font-size: 0.8em; color: #718096; margin-top: 6px;">
                        {{ $notification->created_at->diffForHumans() }}
                    </div>
                </div>
            @empty
                <p style="color: #718096;">У вас пока нет уведомлений.</p>
            @endforelse

            <div style="margin-top: 20px;">
                {{ $notifications->links() }}
            </div>
        </div>
    </div>
@endsection