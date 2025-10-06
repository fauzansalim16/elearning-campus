<?php

namespace App\Http\Controllers;

use App\Http\Requests\Submission\GradeSubmissionRequest;
use App\Http\Requests\Submission\StoreSubmissionRequest;
use App\Models\Assignment;
use App\Models\Submission;
use App\Services\SubmissionService;
use App\Jobs\SendSubmissionGradedNotification;
use Illuminate\Http\JsonResponse;

class SubmissionController extends Controller
{
    public function __construct(private SubmissionService $submissions)
    {
    }

    public function store(StoreSubmissionRequest $request): JsonResponse
    {
        $assignment = Assignment::findOrFail($request->input('assignment_id'));
        $this->authorize('submit', [Submission::class, $assignment]);
        $submission = $this->submissions->submit($assignment, $request->user()->id, $request->file('file'));
        return response()->json([
            'id' => $submission->id,
            'file_path' => $submission->file_path,
        ], 201);
    }

    public function grade(GradeSubmissionRequest $request, int $id): JsonResponse
    {
        $submission = Submission::findOrFail($id);
        $this->authorize('grade', $submission);
        $submission = $this->submissions->grade($submission->id, (int) $request->input('score'));
        SendSubmissionGradedNotification::dispatch($submission);
        return response()->json([
            'id' => $submission->id,
            'score' => $submission->score,
        ]);
    }
}


