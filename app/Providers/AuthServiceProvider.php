<?php

namespace App\Providers;

use App\Models\Course;
use App\Policies\CoursePolicy;
use App\Models\Material;
use App\Policies\MaterialPolicy;
use App\Models\Assignment;
use App\Policies\AssignmentPolicy;
use App\Models\Submission;
use App\Policies\SubmissionPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Course::class => CoursePolicy::class,
        Material::class => MaterialPolicy::class,
        Assignment::class => AssignmentPolicy::class,
        Submission::class => SubmissionPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}


