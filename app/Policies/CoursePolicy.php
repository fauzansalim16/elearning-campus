<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;

class CoursePolicy
{
    public function create(User $user): bool
    {
        return $user->role === 'lecturer';
    }

    public function update(User $user, Course $course): bool
    {
        return $user->role === 'lecturer' && $course->lecturer_id === $user->id;
    }

    public function delete(User $user, Course $course): bool
    {
        return $user->role === 'lecturer' && $course->lecturer_id === $user->id;
    }
}



