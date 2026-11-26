@extends('layouts.admin')
@section('title', 'Dashboard')
@section('heading', 'Dashboard')
@section('actions')<a class="btn" href="{{ route('admin.shifts.create') }}">+ New shift</a>@endsection
@section('content')
<div class="stats">
    <a class="stat" href="{{ route('admin.records.index', ['type' => 'inquiries', 'status' => 'new']) }}"><b>{{ $counts['inquiries'] }}</b>New inquiries</a>
    <a class="stat" href="{{ route('admin.records.index', ['type' => 'applications', 'status' => 'new']) }}"><b>{{ $counts['applications'] }}</b>New applications</a>
    <a class="stat" href="{{ route('admin.records.index', ['type' => 'staffing', 'status' => 'new']) }}"><b>{{ $counts['staffing'] }}</b>New facility requests</a>
    <a class="stat {{ $unassigned->count() ? 'warn' : '' }}" href="{{ route('admin.shifts.index', ['unassigned' => 1]) }}"><b>{{ $unassigned->count() }}</b>Upcoming shifts without a caregiver</a>
</div>

<div class="grid2">
    <div class="panel">
        <h2>Today's shifts</h2>
        @forelse($today as $s)
            <a class="row" href="{{ route('admin.shifts.edit', $s) }}">
                <span>{{ $s->starts_at->format('g:i A') }}–{{ $s->ends_at->format('g:i A') }}</span>
                <span>{{ $s->caregiver?->name ?? 'Unassigned' }} → {{ $s->client?->name ?? ($s->location ?: '—') }}</span>
                <span class="chip {{ $s->status }}">{{ \App\Models\Shift::STATUSES[$s->status] ?? $s->status }}</span>
            </a>
        @empty
            <p class="muted">No shifts scheduled today.</p>
        @endforelse
    </div>
    <div class="panel">
        <h2>Needs a caregiver</h2>
        @forelse($unassigned as $s)
            <a class="row" href="{{ route('admin.shifts.edit', $s) }}">
                <span>{{ $s->starts_at->format('M j, g:i A') }}</span>
                <span>{{ $s->client?->name ?? ($s->location ?: '—') }}</span>
            </a>
        @empty
            <p class="muted">Every upcoming shift has a caregiver.</p>
        @endforelse
    </div>
</div>

<div class="grid3">
    @foreach(['inquiries' => 'Latest inquiries', 'applications' => 'Latest applications', 'staffing' => 'Latest facility requests'] as $type => $label)
        <div class="panel">
            <h2>{{ $label }}</h2>
            @forelse($recent[$type] as $rec)
                <a class="row" href="{{ route('admin.records.show', ['type' => $type, 'id' => $rec->id]) }}">
                    <span>{{ $rec->name ?? $rec->facility_name }}</span>
                    <span class="muted">{{ $rec->created_at->diffForHumans() }}</span>
                </a>
            @empty
                <p class="muted">Nothing yet.</p>
            @endforelse
        </div>
    @endforeach
</div>
@endsection
