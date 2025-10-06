<?php

namespace App\Policies;

use App\Models\Assignment;
use App\Models\Course;
use App\Models\User;

class AssignmentPolicy
{
    public function create(User $user, Course $course): bool
    {
        return $user->role === 'lecturer' && $course->lecturer_id === $user->id;
    }
}



