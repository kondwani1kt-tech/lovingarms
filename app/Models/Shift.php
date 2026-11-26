<?php

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    public const STATUSES = [
        'scheduled' => 'Scheduled', 'confirmed' => 'Confirmed', 'completed' => 'Completed',
        'cancelled' => 'Cancelled', 'no_show' => 'No-show',
    ];

    protected $guarded = [];

    protected $casts = ['starts_at' => 'datetime', 'ends_at' => 'datetime'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function caregiver()
    {
        return $this->belongsTo(Caregiver::class);
    }

    /** Another non-cancelled shift for this caregiver that overlaps the given window. */
    public static function conflictFor(int $caregiverId, CarbonInterface $start, CarbonInterface $end, ?int $ignoreId = null): ?self
    {
        return static::where('caregiver_id', $caregiverId)
            ->where('status', '!=', 'cancelled')
            ->where('starts_at', '<', $end)
            ->where('ends_at', '>', $start)
            ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
            ->first();
    }
}
