<?php

namespace App\Services;

use App\Models\Assignment;
use App\Models\Submission;
use App\Repositories\SubmissionRepository;
use Illuminate\Http\UploadedFile;

class SubmissionService
{
    public function __construct(private SubmissionRepository $submissions)
    {
    }

    public function submit(Assignment $assignment, int $studentId, UploadedFile $file): Submission
    {
        $path = $file->store('submissions', 'public');
        return $this->submissions->create([
            'assignment_id' => $assignment->id,
            'student_id' => $studentId,
            'file_path' => $path,
        ]);
    }

    public function grade(int $submissionId, int $score): Submission
    {
        $submission = $this->submissions->findOrFail($submissionId);
        return $this->submissions->update($submission, ['score' => $score]);
    }
}



