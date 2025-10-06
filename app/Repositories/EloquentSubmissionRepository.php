<?php

namespace App\Repositories;

use App\Models\Submission;

class EloquentSubmissionRepository implements SubmissionRepository
{
    public function create(array $data): Submission
    {
        return Submission::create($data);
    }

    public function findOrFail(int $id): Submission
    {
        return Submission::findOrFail($id);
    }

    public function update(Submission $submission, array $data): Submission
    {
        $submission->update($data);
        return $submission;
    }
}



