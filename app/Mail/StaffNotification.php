<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class StaffNotification extends Mailable
{
    public function __construct(
        public string $heading,
        public array $rows,
        public ?string $link = null,
        public ?string $intro = null,
    ) {
        $this->subject($heading);
    }

    public function build()
    {
        return $this->view('emails.notification');
    }

    /** Send to the staff inbox. A mail failure must never break a public form submission. */
    public static function notify(string $heading, array $rows, ?string $link = null, ?string $intro = null): void
    {
        $to = config('loving.notify_to');
        if (! $to) {
            return;
        }

        try {
            Mail::to($to)->send(new static($heading, $rows, $link, $intro));
        } catch (\Throwable $e) {
            report($e);
        }
    }
}
