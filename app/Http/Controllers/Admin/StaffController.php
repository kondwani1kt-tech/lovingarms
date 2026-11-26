<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\SupabaseAuth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/** Administrator-only: invite, change and remove staff logins. */
class StaffController extends Controller
{
    public function index()
    {
        return view('admin.staff.index', ['users' => User::orderBy('name')->get()]);
    }

    public function create()
    {
        return view('admin.staff.form', ['user' => null]);
    }

    public function store(Request $r, SupabaseAuth $supabase)
    {
        $d = $r->validate([
            'name' => 'required|string|max:120',
            'email' => 'required|email|max:190|unique:users,email',
            'role' => ['required', Rule::in(array_keys(User::ROLES))],
            'password' => 'required|string|min:10|max:100',
        ]);
        $email = strtolower($d['email']);

        try {
            $sb = $supabase->createUser($email, $d['password']);
        } catch (\Throwable $e) {
            return back()->withInput($r->except('password'))->withErrors(['email' => $e->getMessage()]);
        }

        User::create(['name' => $d['name'], 'email' => $email, 'role' => $d['role'], 'supabase_id' => $sb['id'] ?? null]);

        return redirect()->route('admin.staff.index')->with('success', 'Staff login created. Share the password with them privately.');
    }

    public function edit(User $user)
    {
        return view('admin.staff.form', ['user' => $user]);
    }

    public function update(Request $r, User $user, SupabaseAuth $supabase)
    {
        $d = $r->validate([
            'name' => 'required|string|max:120',
            'role' => ['required', Rule::in(array_keys(User::ROLES))],
            'new_password' => 'nullable|string|min:10|max:100',
        ]);
        $d['is_active'] = $r->boolean('is_active');

        if ($user->id === $r->user()->id) {   // never lock yourself out
            $d['role'] = $user->role;
            $d['is_active'] = true;
        }

        if (! empty($d['new_password'])) {
            if (! $user->supabase_id) {
                return back()->withErrors(['new_password' => 'This person has not signed in yet, so there is no login to update.']);
            }
            try {
                $supabase->setPassword($user->supabase_id, $d['new_password']);
            } catch (\Throwable $e) {
                return back()->withErrors(['new_password' => $e->getMessage()]);
            }
        }
        unset($d['new_password']);

        $user->update($d);

        return redirect()->route('admin.staff.index')->with('success', 'Staff member updated.');
    }

    public function destroy(Request $r, User $user, SupabaseAuth $supabase)
    {
        if ($user->id === $r->user()->id) {
            return back()->withErrors(['user' => 'You cannot delete your own account.']);
        }

        if ($user->supabase_id) {
            try {
                $supabase->deleteUser($user->supabase_id);
            } catch (\Throwable $e) {
                report($e);
            }
        }
        $user->delete();

        return redirect()->route('admin.staff.index')->with('success', 'Staff member removed.');
    }
}
