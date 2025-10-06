<?php

namespace App\Services;

use App\Models\Course;
use App\Models\Material;
use App\Repositories\MaterialRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class MaterialService
{
    public function __construct(private MaterialRepository $materials)
    {
    }

    public function upload(Course $course, string $title, UploadedFile $file): Material
    {
        $path = $file->store('materials', 'public');
        return $this->materials->create([
            'course_id' => $course->id,
            'title' => $title,
            'file_path' => $path,
        ]);
    }

    public function getPath(int $materialId): string
    {
        $material = $this->materials->findOrFail($materialId);
        return $material->file_path;
    }
}



