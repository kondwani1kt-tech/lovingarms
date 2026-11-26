<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use RuntimeException;

/**
 * Thin wrapper around Supabase Auth (GoTrue) REST endpoints.
 * Supabase only stores staff logins; roles and profile data live in the local `users` table.
 */
class SupabaseAuth
{
    private function base(): string
    {
        return config('loving.supabase.url');
    }

    private function asAnon(): PendingRequest
    {
        return Http::withHeaders(['apikey' => config('loving.supabase.anon_key')])->acceptJson()->timeout(10);
    }

    private function asAdmin(): PendingRequest
    {
        $key = config('loving.supabase.service_key');

        return Http::withHeaders(['apikey' => $key, 'Authorization' => 'Bearer '.$key])->acceptJson()->timeout(10);
    }

    /** Returns the Supabase user array on success, null when the credentials are wrong. */
    public function signIn(string $email, string $password): ?array
    {
        $r = $this->asAnon()->post($this->base().'/auth/v1/token?grant_type=password', [
            'email' => $email,
            'password' => $password,
        ]);

        return $r->successful() ? $r->json('user') : null;
    }

    public function createUser(string $email, string $password): array
    {
        $r = $this->asAdmin()->post($this->base().'/auth/v1/admin/users', [
            'email' => $email,
            'password' => $password,
            'email_confirm' => true,
        ]);

        if ($r->failed()) {
            throw new RuntimeException($r->json('msg') ?? $r->json('message') ?? 'Supabase could not create the login.');
        }

        return $r->json();
    }

    public function setPassword(string $supabaseId, string $password): void
    {
        $r = $this->asAdmin()->put($this->base().'/auth/v1/admin/users/'.$supabaseId, ['password' => $password]);

        if ($r->failed()) {
            throw new RuntimeException($r->json('msg') ?? $r->json('message') ?? 'Supabase could not update the password.');
        }
    }

    public function deleteUser(string $supabaseId): void
    {
        $this->asAdmin()->delete($this->base().'/auth/v1/admin/users/'.$supabaseId);
    }
}
