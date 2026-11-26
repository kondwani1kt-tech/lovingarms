<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Services\SupabaseAuth;
use Illuminate\Console\Command;

class CreateStaffUser extends Command
{
    protected $signature = 'staff:create {email} {name} {--role=admin : admin or staff} {--local-only : Supabase login already exists; only add the local profile}';

    protected $description = 'Create a staff login in Supabase and the matching local profile (use this for the first admin).';

    public function handle(SupabaseAuth $supabase): int
    {
        $role = $this->option('role');
        if (! array_key_exists($role, User::ROLES)) {
            $this->error('Role must be one of: '.implode(', ', array_keys(User::ROLES)));

            return self::FAILURE;
        }

        $email = strtolower($this->argument('email'));
        $supabaseId = null;

        if (! $this->option('local-only')) {
            $password = $this->secret('Password (at least 10 characters)');
            if (strlen((string) $password) < 10) {
                $this->error('Password is too short.');

                return self::FAILURE;
            }

            try {
                $supabaseId = $supabase->createUser($email, $password)['id'] ?? null;
            } catch (\Throwable $e) {
                $this->error($e->getMessage());

                return self::FAILURE;
            }
        }

        User::updateOrCreate(
            ['email' => $email],
            array_filter(['name' => $this->argument('name'), 'role' => $role, 'is_active' => true, 'supabase_id' => $supabaseId], fn ($v) => $v !== null)
        );

        $this->info("Staff user {$email} ready ({$role}).");

        return self::SUCCESS;
    }
}
