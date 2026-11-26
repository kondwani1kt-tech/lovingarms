<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Throwable;

class SubmissionConfirmation extends Mailable
{
    public function __construct(
        public string $name,
        public string $subjectLine,
        public string $intro,
        public array $lines,
        public ?string $link = null,
    ) {
        $this->subject($subjectLine);
    }

    public function build()
    {
        return $this->view('emails.confirmation');
    }

    public static function sendTo(string $email, string $name, string $subject, string $intro, array $lines, ?string $link = null): void
    {
        if (trim($email) === '') {
            return;
        }

        try {
            Mail::to($email)->send(new static($name, $subject, $intro, $lines, $link));
        } catch (Throwable $e) {
            report($e);
        }
    }
}
