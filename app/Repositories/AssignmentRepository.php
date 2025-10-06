<?php

namespace App\Repositories;

use App\Models\Assignment;

interface AssignmentRepository
{
    public function create(array $data): Assignment;

    public function findOrFail(int $id): Assignment;
}



