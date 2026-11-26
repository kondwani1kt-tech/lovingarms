<?php

namespace App\Models;

use App\Models\Concerns\Trackable;
use Illuminate\Database\Eloquent\Model;

class StaffingRequest extends Model
{
    use Trackable;

    public const STATUSES = [
        'new' => 'New', 'reviewing' => 'Reviewing', 'proposal_sent' => 'Proposal sent',
        'active' => 'Active partner', 'closed' => 'Closed',
    ];

    public const FACILITY_TYPES = [
        'Skilled nursing / rehabilitation facility', 'Assisted living community', 'Adult family home',
        'Home and community-based care organization', 'Other healthcare provider',
    ];

    protected $guarded = [];
}
