<?php

namespace App\Repositories;

use App\Models\Assignment;

class EloquentAssignmentRepository implements AssignmentRepository
{
    public function create(array $data): Assignment
    {
        return Assignment::create($data);
    }

    public function findOrFail(int $id): Assignment
    {
        return Assignment::findOrFail($id);
    }
}



