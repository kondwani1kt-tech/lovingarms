<?php

namespace App\Models;

use App\Models\Concerns\Trackable;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use Trackable;

    public const STATUSES = [
        'new' => 'New', 'contacted' => 'Contacted', 'in_progress' => 'In progress', 'closed' => 'Closed',
    ];

    public const TOPICS = [
        'Home care for myself or a family member',
        'Private-pay services',
        'Medicaid service question',
        'CNA / caregiver staffing for a facility',
        'Employment / career opportunity',
        'Other',
    ];

    public const RELATIONSHIPS = [
        'parent' => 'My parent(s)',
        'spouse' => 'My spouse',
        'myself' => 'Myself',
        'other' => 'Someone else',
    ];

    public const URGENCIES = [
        'asap' => 'As soon as possible',
        'weeks' => 'Within a few weeks',
        'exploring' => 'Just exploring',
    ];

    public const SOURCES = [
        'google' => 'Google',
        'facebook' => 'Facebook',
        'friend' => 'Friend or family',
        'word_of_mouth' => 'Word of mouth',
        'other' => 'Other',
    ];

    public const PREFERRED_CONTACT = [
        'email' => 'Email',
        'phone' => 'Phone call',
        'text' => 'Text message',
    ];

    protected $guarded = [];
}
