<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\SupabaseAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function show()
    {
        return view('admin.login');
    }

    public function login(Request $r, SupabaseAuth $supabase)
    {
        $data = $r->validate(['email' => 'required|email', 'password' => 'required|string']);
        $email = strtolower($data['email']);
        $fail = fn (string $msg) => back()->withErrors(['email' => $msg])->onlyInput('email');

        try {
            $sb = $supabase->signIn($email, $data['password']);
        } catch (\Throwable $e) {
            report($e);

            return $fail('Sign-in is temporarily unavailable. Please try again shortly.');
        }

        // Only people added by an administrator (local profile) may enter, even with a valid Supabase login.
        $user = User::where('email', $email)->where('is_active', true)->first();

        if (! $sb || ! $user || ($user->supabase_id && $user->supabase_id !== ($sb['id'] ?? null))) {
            return $fail('These credentials do not match our records.');
        }

        if (! $user->supabase_id) {
            $user->update(['supabase_id' => $sb['id']]);
        }

        Auth::login($user);
        $r->session()->regenerate();

        return redirect()->intended(route('admin.dashboard'));
    }

    public function logout(Request $r)
    {
        Auth::logout();
        $r->session()->invalidate();
        $r->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
