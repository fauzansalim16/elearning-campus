<?php

namespace App\Policies;

use App\Models\Assignment;
use App\Models\Submission;
use App\Models\User;

class SubmissionPolicy
{
    public function submit(User $user, Assignment $assignment): bool
    {
        if ($user->role !== 'student') {
            return false;
        }
        return $user->coursesEnrolled()->where('courses.id', $assignment->course_id)->exists();
    }

    public function grade(User $user, Submission $submission): bool
    {
        return $user->role === 'lecturer' && $submission->assignment->course->lecturer_id === $user->id;
    }
}



