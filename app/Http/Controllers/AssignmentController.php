<?php

namespace App\Http\Controllers;

use App\Http\Requests\Assignment\StoreAssignmentRequest;
use App\Models\Assignment;
use App\Models\Course;
use App\Services\AssignmentService;
use App\Jobs\SendNewAssignmentNotification;
use Illuminate\Http\JsonResponse;

class AssignmentController extends Controller
{
    public function __construct(private AssignmentService $assignments)
    {
    }

    public function store(StoreAssignmentRequest $request): JsonResponse
    {
        $course = Course::findOrFail($request->input('course_id'));
        $this->authorize('create', [Assignment::class, $course]);
        $assignment = $this->assignments->create($course, $request->validated());
        SendNewAssignmentNotification::dispatch($assignment);
        return response()->json([
            'id' => $assignment->id,
            'title' => $assignment->title,
            'deadline' => $assignment->deadline,
        ], 201);
    }
}


