<?php

namespace App\Models\Concerns;

use App\Models\Note;

trait Trackable
{
    public function notes()
    {
        return $this->morphMany(Note::class, 'noteable')->latest();
    }
}
