<?php

namespace App\Services;

use App\Models\Course;
use App\Models\Booking;
use App\Models\User;
use App\Jobs\RemindAboutBooking;
use Illuminate\Validation\ValidationException;

class BookingService
{
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

        // Диспетчеризация отложенной задачи напоминания (Задание 5)
        RemindAboutBooking::dispatch($booking)->delay(now()->addMinute());

        return $booking;
    }
}