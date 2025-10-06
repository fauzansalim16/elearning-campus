<?php

namespace App\Services;

use App\Models\Assignment;
use App\Models\Course;
use App\Models\Submission;
use Illuminate\Support\Collection;

class ReportService
{
    public function coursesSummary(): Collection
    {
        return Course::query()
            ->withCount('students')
            ->get()
            ->map(fn ($c) => [
                'course' => $c->name,
                'student_count' => $c->students_count,
            ]);
    }

    public function assignmentsSummary(): array
    {
        $graded = Submission::query()->whereNotNull('score')->count();
        $ungraded = Submission::query()->whereNull('score')->count();
        return [
            'graded' => $graded,
            'ungraded' => $ungraded,
        ];
    }

    public function studentStats(int $studentId): array
    {
        $submissions = Submission::query()->where('student_id', $studentId);
        $count = $submissions->count();
        $avg = (float) $submissions->whereNotNull('score')->avg('score');
        return [
            'student_id' => $studentId,
            'submission_count' => $count,
            'average_score' => $avg,
        ];
    }
}



