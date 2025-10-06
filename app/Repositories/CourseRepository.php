<?php

namespace App\Repositories;

use App\Models\Course;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CourseRepository
{
    public function paginate(int $perPage = 15): LengthAwarePaginator;

    public function create(array $data): Course;

    public function update(Course $course, array $data): Course;

    public function delete(Course $course): void;

    public function findOrFail(int $id): Course;
}

