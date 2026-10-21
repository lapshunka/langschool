<?php

namespace App\Services;

use App\Contracts\SmsSender;
use App\Models\Course;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class BookingService
{
    public function __construct(private SmsSender $sms) {}

    public function create(User $user, Course $course, array $data): Booking
    {
        $activeCount = $user->bookings()->where('status', 'new')->count();
        if ($activeCount >= 3) {
            throw ValidationException::withMessages([
                'phone' => 'У вас уже есть 3 активные заявки. Дождитесь их обработки.',
            ]);
        }

        $exists = $user->bookings()
            ->where('course_id', $course->id)
            ->where('status', 'new')
            ->exists();

        if ($exists) {
            throw ValidationException::withMessages([
                'phone' => 'Вы уже отправили заявку на этот курс.',
            ]);
        }

        $booking = $user->bookings()->create([
            'course_id' => $course->id,
            'phone' => $data['phone'],
            'comment' => $data['comment'] ?? null,
            'status' => 'new',
        ]);

        // Отправка SMS через внедрённый через контейнер сервис
        $this->sms->send($data['phone'], "Заявка №{$booking->id} принята");

        return $booking;
    }
}