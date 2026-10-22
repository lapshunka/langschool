<?php

namespace App\Jobs;

use App\Models\Booking;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Throwable;

class RemindAboutBooking implements ShouldQueue
{
    use Queueable;

    // Настройки повторных попыток и задержки при сбое (Задание 5)
    public int $tries = 3;
    public int $backoff = 15; // Секунд перед повторной попыткой

    public function __construct(public Booking $booking) {}

    public function handle(): void
    {
        // Проверяем, если заявка всё еще в статусе 'new', отправляем напоминание
        if ($this->booking->status === 'new') {
            Log::info("Напоминание: Заявка №{$this->booking->id} ожидает обработки администратором.");
            
            // Здесь можно отправить уведомление или email пользователю/админу
            // Например: $this->booking->user->notify(new \App\Notifications\BookingReminder($this->booking));
        }
    }

    /**
     * Обработка окончательного сбоя задачи после исчерпания всех попыток
     */
    public function failed(?Throwable $e): void
    {
        Log::error("Ошибка выполнения задачи RemindAboutBooking для заявки #{$this->booking->id}: " . $e?->getMessage());
    }
}