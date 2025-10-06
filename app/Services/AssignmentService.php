<?php

namespace App\Services;

use App\Models\Assignment;
use App\Models\Course;
use App\Repositories\AssignmentRepository;

class AssignmentService
{
    public function __construct(private AssignmentRepository $assignments)
    {
    }

    public function create(Course $course, array $data): Assignment
    {
        $data['course_id'] = $course->id;
        return $this->assignments->create($data);
    }

    public function find(int $id): Assignment
    {
        return $this->assignments->findOrFail($id);
    }
}



