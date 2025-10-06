<?php

namespace App\Repositories;

use App\Models\Submission;

interface SubmissionRepository
{
    public function create(array $data): Submission;

    public function findOrFail(int $id): Submission;

    public function update(Submission $submission, array $data): Submission;
}



