<?php

namespace App\Jobs;

use App\Mail\NewAssignmentMail;
use App\Models\Assignment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNewAssignmentNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Assignment $assignment)
    {
    }

    public function handle(): void
    {
        $students = $this->assignment->course->students()->get();
        foreach ($students as $student) {
            Mail::to($student->email)->send(new NewAssignmentMail($this->assignment));
        }
    }
}



