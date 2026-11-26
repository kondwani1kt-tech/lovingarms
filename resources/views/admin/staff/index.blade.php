@extends('layouts.admin')
@section('title', 'Staff logins')
@section('heading', 'Staff logins')
@section('actions')<a class="btn" href="{{ route('admin.staff.create') }}">+ Add staff member</a>@endsection
@section('content')
<div class="tablewrap">
<table>
    <thead><tr><th>Name</th><th>Email</th><th>Role</th><th>Status</th></tr></thead>
    <tbody>
    @foreach($users as $u)
        <tr class="click" onclick="location='{{ route('admin.staff.edit', $u) }}'">
            <td>{{ $u->name }}</td><td>{{ $u->email }}</td>
            <td>{{ \App\Models\User::ROLES[$u->role] ?? $u->role }}</td>
            <td><span class="chip {{ $u->is_active ? 'confirmed' : 'cancelled' }}">{{ $u->is_active ? 'Active' : 'Disabled' }}</span></td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>
<p class="muted">Administrators can manage staff logins and delete records. Staff can work with inquiries, applications, scheduling and reports.</p>
@endsection
