<?php

namespace App\Listeners;

use App\Contracts\SmsSender;
use App\Events\BookingCreated;

class SendBookingSms
{
    // Внедряем интерфейс SmsSender через контейнер зависимостей из ЛР №9
    public function __construct(private SmsSender $sms) {}

    public function handle(BookingCreated $event): void
    {
        $booking = $event->booking;
        $this->sms->send($booking->phone, "Заявка №{$booking->id} принята");
    }
}