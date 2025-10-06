<?php

namespace App\Http\Controllers;

use App\Http\Requests\Course\StoreCourseRequest;
use App\Http\Requests\Course\UpdateCourseRequest;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use App\Services\CourseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function __construct(private CourseService $courses)
    {
    }

    public function index(Request $request): JsonResponse
    {
        $courses = $this->courses->list();
        return response()->json([
            'data' => CourseResource::collection($courses->items()),
            'meta' => [
                'current_page' => $courses->currentPage(),
                'last_page' => $courses->lastPage(),
                'per_page' => $courses->perPage(),
                'total' => $courses->total(),
            ],
        ]);
    }

    public function store(StoreCourseRequest $request): JsonResponse
    {
        $this->authorize('create', Course::class);
        $course = $this->courses->create($request->validated(), $request->user()->id);
        return response()->json(new CourseResource($course), 201);
    }

    public function update(UpdateCourseRequest $request, int $id): JsonResponse
    {
        $course = Course::findOrFail($id);
        $this->authorize('update', $course);
        $course = $this->courses->update($id, $request->validated());
        return response()->json(new CourseResource($course));
    }

    public function destroy(int $id): JsonResponse
    {
        $course = Course::findOrFail($id);
        $this->authorize('delete', $course);
        $this->courses->delete($id);
        return response()->json(['message' => 'Deleted']);
    }

    public function enroll(int $id): JsonResponse
    {
        $course = $this->courses->enroll($id, request()->user()->id);
        return response()->json(new CourseResource($course));
    }
}



