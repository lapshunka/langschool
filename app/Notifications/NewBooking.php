<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewBooking extends Notification
{
    use Queueable;

    public function __construct(public Booking $booking) {}

    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Новая заявка №' . $this->booking->id)
            ->line("Пользователь {$this->booking->user->name} оставил заявку на курс «{$this->booking->course->title}».")
            ->action('Открыть заявки', route('admin.bookings.index'));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'booking_id' => $this->booking->id,
            'text'       => "Новая заявка №{$this->booking->id} от {$this->booking->user->name}",
        ];
    }
}