@extends('layouts.admin')
@section('title', $user ? 'Edit staff member' : 'Add staff member')
@section('heading', $user ? 'Edit staff member' : 'Add staff member')
@section('actions')<a class="btn ghost" href="{{ route('admin.staff.index') }}">← Back</a>@endsection
@section('content')
<form class="panel formgrid" method="POST" action="{{ $user ? route('admin.staff.update', $user) : route('admin.staff.store') }}">
    @csrf
    @if($user) @method('PUT') @endif
    <div class="fields">
        @include('partials.field', ['name' => 'name', 'label' => 'Full name', 'required' => true, 'full' => true, 'value' => $user?->name])
        @if($user)
            <div class="field full"><label>Email</label><input value="{{ $user->email }}" disabled></div>
        @else
            @include('partials.field', ['name' => 'email', 'label' => 'Email', 'type' => 'email', 'required' => true, 'full' => true])
        @endif
        @include('partials.field', ['name' => 'role', 'label' => 'Role', 'type' => 'select', 'required' => true, 'full' => true, 'options' => \App\Models\User::ROLES, 'value' => $user?->role ?? 'staff', 'blank' => 'Choose role'])
        @if($user)
            <div class="field full"><label class="check"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $user->is_active))><span>Account active (untick to block sign-in)</span></label></div>
            @include('partials.field', ['name' => 'new_password', 'label' => 'Set a new password (leave blank to keep the current one)', 'type' => 'password', 'full' => true])
        @else
            @include('partials.field', ['name' => 'password', 'label' => 'Temporary password (at least 10 characters)', 'type' => 'password', 'required' => true, 'full' => true])
        @endif
    </div>
    <button class="btn">Save</button>
</form>
@if($user && $user->id !== auth()->id())
    <form method="POST" action="{{ route('admin.staff.destroy', $user) }}" onsubmit="return confirm('Remove this staff member and their login?')">@csrf @method('DELETE')
        <button class="btn danger">Remove staff member</button>
    </form>
@endif
@endsection
