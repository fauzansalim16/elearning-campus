<?php

namespace App\Repositories;

use App\Models\Course;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EloquentCourseRepository implements CourseRepository
{
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return Course::query()->with('lecturer')->paginate($perPage);
    }

    public function create(array $data): Course
    {
        return Course::create($data);
    }

    public function update(Course $course, array $data): Course
    {
        $course->update($data);
        return $course;
    }

    public function delete(Course $course): void
    {
        $course->delete();
    }

    public function findOrFail(int $id): Course
    {
        return Course::query()->with('lecturer', 'students')->findOrFail($id);
    }
}



