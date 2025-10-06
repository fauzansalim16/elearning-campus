<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\ReportController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    // Forum
    Route::post('/discussions', [DiscussionController::class, 'store']);
    Route::post('/discussions/{id}/replies', [DiscussionController::class, 'reply']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Contoh rute terbatas per role:
    Route::middleware('role:lecturer')->group(function () {
        Route::post('/courses', [CourseController::class, 'store']);
        Route::put('/courses/{id}', [CourseController::class, 'update']);
        Route::delete('/courses/{id}', [CourseController::class, 'destroy']);
        Route::post('/materials', [MaterialController::class, 'store']);
        Route::post('/assignments', [AssignmentController::class, 'store']);
        Route::post('/submissions/{id}/grade', [SubmissionController::class, 'grade']);
    });

    Route::middleware('role:student')->group(function () {
        Route::post('/courses/{id}/enroll', [CourseController::class, 'enroll']);
        Route::post('/submissions', [SubmissionController::class, 'store']);
    });

    Route::get('/materials/{id}/download', [MaterialController::class, 'download']);
});

Route::get('/courses', [CourseController::class, 'index']);

// Reports
Route::get('/reports/courses', [ReportController::class, 'courses']);
Route::get('/reports/assignments', [ReportController::class, 'assignments']);
Route::get('/reports/students/{id}', [ReportController::class, 'student']);


