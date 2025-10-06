<?php

namespace App\Services;

use App\Models\Course;
use App\Repositories\CourseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CourseService
{
    public function __construct(private CourseRepository $courses)
    {
    }

    public function list(int $perPage = 15): LengthAwarePaginator
    {
        return $this->courses->paginate($perPage);
    }

    public function create(array $data, int $lecturerId): Course
    {
        $data['lecturer_id'] = $lecturerId;
        return $this->courses->create($data);
    }

    public function update(int $id, array $data): Course
    {
        $course = $this->courses->findOrFail($id);
        return $this->courses->update($course, $data);
    }

    public function delete(int $id): void
    {
        $course = $this->courses->findOrFail($id);
        $this->courses->delete($course);
    }

    public function enroll(int $courseId, int $studentId): Course
    {
        $course = $this->courses->findOrFail($courseId);
        $course->students()->syncWithoutDetaching([$studentId]);
        return $course->refresh();
    }
}



