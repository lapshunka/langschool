<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;

class CoursePolicy
{
    public function before(User $user): ?bool
    {
        // Админу разрешено абсолютно всё
        return $user->role === 'admin' ? true : null;
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'editor']);
    }

    public function update(User $user, Course $course): bool
    {
        // Редактор может править только свой курс
        return $user->role === 'editor' && $course->user_id === $user->id;
    }

    public function delete(User $user, Course $course): bool
    {
        return $this->update($user, $course);
    }
}