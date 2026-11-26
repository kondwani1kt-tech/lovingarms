@extends('layouts.admin')
@section('title', $shift->exists ? 'Edit shift' : 'New shift')
@section('heading', $shift->exists ? 'Edit shift' : 'New shift')
@section('actions')<a class="btn ghost" href="{{ route('admin.shifts.calendar') }}">← Calendar</a>@endsection
@section('content')
<form class="panel formgrid" method="POST" action="{{ $shift->exists ? route('admin.shifts.update', $shift) : route('admin.shifts.store') }}">
    @csrf
    @if($shift->exists) @method('PUT') @endif
    <div class="fields">
        @include('partials.field', ['name' => 'client_id', 'label' => 'Client', 'type' => 'select', 'blank' => '— none (use location) —', 'options' => $clients, 'value' => $shift->client_id])
        @include('partials.field', ['name' => 'caregiver_id', 'label' => 'Caregiver', 'type' => 'select', 'blank' => '— unassigned —', 'options' => $caregivers, 'value' => $shift->caregiver_id])
        @include('partials.field', ['name' => 'starts_at', 'label' => 'Starts', 'type' => 'datetime-local', 'required' => true, 'value' => $shift->starts_at?->format('Y-m-d\TH:i')])
        @include('partials.field', ['name' => 'ends_at', 'label' => 'Ends', 'type' => 'datetime-local', 'required' => true, 'value' => $shift->ends_at?->format('Y-m-d\TH:i')])
        @include('partials.field', ['name' => 'location', 'label' => 'Location (for facility or one-off shifts)', 'value' => $shift->location, 'full' => true])
        @include('partials.field', ['name' => 'status', 'label' => 'Status', 'type' => 'select', 'required' => true, 'options' => \App\Models\Shift::STATUSES, 'value' => $shift->status, 'blank' => 'Choose status'])
        @include('partials.field', ['name' => 'notes', 'label' => 'Notes', 'type' => 'textarea', 'full' => true, 'value' => $shift->notes])
    </div>
    <button class="btn">Save shift</button>
</form>
@if($shift->exists && auth()->user()->isAdmin())
    <form method="POST" action="{{ route('admin.shifts.destroy', $shift) }}" onsubmit="return confirm('Delete this shift?')">@csrf @method('DELETE')
        <button class="btn danger">Delete shift</button>
    </form>
@endif
@endsection
