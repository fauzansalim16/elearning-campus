<?php

namespace App\Mail;

use App\Models\Submission;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubmissionGradedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Submission $submission)
    {
    }

    public function build(): self
    {
        return $this->subject('Nilai Tugas Dirilis')
            ->text('emails.submission_graded_plain');
    }
}



