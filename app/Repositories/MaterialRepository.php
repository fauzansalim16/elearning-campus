<?php

namespace App\Repositories;

use App\Models\Material;

interface MaterialRepository
{
    public function create(array $data): Material;

    public function findOrFail(int $id): Material;
}



