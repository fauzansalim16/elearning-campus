<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\Material;
use App\Models\User;

class MaterialPolicy
{
    public function create(User $user, Course $course): bool
    {
        return $user->role === 'lecturer' && $course->lecturer_id === $user->id;
    }

    public function download(User $user, Material $material): bool
    {
        if ($user->role === 'lecturer') {
            return $material->course->lecturer_id === $user->id;
        }

        if ($user->role === 'student') {
            return $user->coursesEnrolled()->where('courses.id', $material->course_id)->exists();
        }

        return false;
    }
}



