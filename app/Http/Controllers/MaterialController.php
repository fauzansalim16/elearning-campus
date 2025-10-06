<?php

namespace App\Http\Controllers;

use App\Http\Requests\Material\StoreMaterialRequest;
use App\Models\Course;
use App\Models\Material;
use App\Services\MaterialService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
    public function __construct(private MaterialService $materials)
    {
    }

    public function store(StoreMaterialRequest $request): JsonResponse
    {
        $course = Course::findOrFail($request->input('course_id'));
        $this->authorize('create', [Material::class, $course]);

        $material = $this->materials->upload(
            $course,
            $request->input('title'),
            $request->file('file')
        );

        return response()->json([
            'id' => $material->id,
            'title' => $material->title,
            'file_path' => $material->file_path,
        ], 201);
    }

    public function download(int $id)
    {
        $material = Material::findOrFail($id);
        $this->authorize('download', $material);
        return Storage::disk('public')->download($material->file_path);
    }
}



