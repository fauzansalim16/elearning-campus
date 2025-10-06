<?php

namespace App\Repositories;

use App\Models\Material;

class EloquentMaterialRepository implements MaterialRepository
{
    public function create(array $data): Material
    {
        return Material::create($data);
    }

    public function findOrFail(int $id): Material
    {
        return Material::findOrFail($id);
    }
}



