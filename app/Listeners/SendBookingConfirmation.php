<?php

namespace App\Listeners;

use App\Events\BookingCreated;
use App\Mail\BookingReceived;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendBookingConfirmation implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(BookingCreated $event): void
    {
        Mail::to($event->booking->user)->send(new BookingReceived($event->booking));
    }
}