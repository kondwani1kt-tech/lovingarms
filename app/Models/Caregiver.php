<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Caregiver extends Model
{
    protected $guarded = [];

    protected $casts = ['is_active' => 'boolean'];

    public function shifts()
    {
        return $this->hasMany(Shift::class);
    }
}
