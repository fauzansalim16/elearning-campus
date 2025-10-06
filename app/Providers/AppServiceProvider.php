<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\AuthRepository;
use App\Repositories\EloquentAuthRepository;
use App\Repositories\CourseRepository;
use App\Repositories\EloquentCourseRepository;
use App\Repositories\MaterialRepository;
use App\Repositories\EloquentMaterialRepository;
use App\Repositories\AssignmentRepository;
use App\Repositories\EloquentAssignmentRepository;
use App\Repositories\SubmissionRepository;
use App\Repositories\EloquentSubmissionRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthRepository::class, EloquentAuthRepository::class);
        $this->app->bind(CourseRepository::class, EloquentCourseRepository::class);
        $this->app->bind(MaterialRepository::class, EloquentMaterialRepository::class);
        $this->app->bind(AssignmentRepository::class, EloquentAssignmentRepository::class);
        $this->app->bind(SubmissionRepository::class, EloquentSubmissionRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
