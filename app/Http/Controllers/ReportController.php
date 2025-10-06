<?php

namespace App\Http\Controllers;

use App\Services\ReportService;
use Illuminate\Http\JsonResponse;

class ReportController extends Controller
{
    public function __construct(private ReportService $reports)
    {
    }

    public function courses(): JsonResponse
    {
        return response()->json($this->reports->coursesSummary());
    }

    public function assignments(): JsonResponse
    {
        return response()->json($this->reports->assignmentsSummary());
    }

    public function student(int $id): JsonResponse
    {
        return response()->json($this->reports->studentStats($id));
    }
}



