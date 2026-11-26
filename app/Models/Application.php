<?php

namespace App\Models;

use App\Models\Concerns\Trackable;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use Trackable;

    public const STATUSES = [
        'new' => 'New', 'screening' => 'Screening', 'references' => 'Checking references / credentials',
        'interview' => 'Interview', 'hired' => 'Hired', 'declined' => 'Not moving forward',
    ];

    public const ROLES = [
        'Certified Nursing Assistant (CNA)',
        'Home Care Aide / Caregiver',
        'Companion Caregiver',
        'Facility Staffing (CNA / Caregiver)',
        'Other',
    ];

    protected $guarded = [];
}
