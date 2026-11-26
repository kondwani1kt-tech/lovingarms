<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    public const ROLES = ['admin' => 'Administrator', 'staff' => 'Staff'];

    protected $fillable = ['name', 'email', 'role', 'supabase_id', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}
