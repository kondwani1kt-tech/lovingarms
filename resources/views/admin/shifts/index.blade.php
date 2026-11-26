@extends('layouts.admin')
@section('title', 'Shifts')
@section('heading', 'Shifts')
@section('actions')
    <a class="btn ghost" href="{{ route('admin.shifts.calendar') }}">Calendar view</a>
    <a class="btn" href="{{ route('admin.shifts.create') }}">+ New shift</a>
@endsection
@section('content')
<form class="filters" method="GET">
    <label>From <input type="date" name="from" value="{{ $from }}"></label>
    <label>To <input type="date" name="to" value="{{ request('to') }}"></label>
    <select name="status">
        <option value="">All statuses</option>
        @foreach(\App\Models\Shift::STATUSES as $k => $l)<option value="{{ $k }}" @selected(request('status') === $k)>{{ $l }}</option>@endforeach
    </select>
    <label class="check"><input type="checkbox" name="unassigned" value="1" @checked(request()->boolean('unassigned'))> No caregiver</label>
    <button class="btn">Filter</button>
</form>
<div class="tablewrap">
<table>
    <thead><tr><th>When</th><th>Client / location</th><th>Caregiver</th><th>Status</th></tr></thead>
    <tbody>
    @forelse($rows as $s)
        <tr class="click" onclick="location='{{ route('admin.shifts.edit', $s) }}'">
            <td>{{ $s->starts_at->format('D, M j · g:i A') }} – {{ $s->ends_at->format('g:i A') }}</td>
            <td>{{ $s->client?->name ?? ($s->location ?: '—') }}</td>
            <td>{{ $s->caregiver?->name ?? 'Unassigned' }}</td>
            <td><span class="chip {{ $s->status }}">{{ \App\Models\Shift::STATUSES[$s->status] ?? $s->status }}</span></td>
        </tr>
    @empty
        <tr><td colspan="4" class="muted">No shifts match.</td></tr>
    @endforelse
    </tbody>
</table>
</div>
{{ $rows->links() }}
@endsection
