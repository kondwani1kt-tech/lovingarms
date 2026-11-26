@extends('layouts.admin')
@section('title', 'Schedule')
@section('heading', $month->format('F Y'))
@section('actions')
    <a class="btn ghost" href="{{ route('admin.shifts.calendar', ['month' => $month->copy()->subMonth()->format('Y-m')]) }}">‹ Prev</a>
    <a class="btn ghost" href="{{ route('admin.shifts.calendar') }}">Today</a>
    <a class="btn ghost" href="{{ route('admin.shifts.calendar', ['month' => $month->copy()->addMonth()->format('Y-m')]) }}">Next ›</a>
    <a class="btn" href="{{ route('admin.shifts.create') }}">+ New shift</a>
@endsection
@section('content')
<div class="cal">
    @foreach(['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $d)<div class="dow">{{ $d }}</div>@endforeach
    @foreach($days as $day)
        <div class="day {{ $day->month !== $month->month ? 'out' : '' }} {{ $day->isToday() ? 'today' : '' }}">
            <a class="num" href="{{ route('admin.shifts.create', ['date' => $day->toDateString()]) }}" title="Add a shift on this day">{{ $day->day }}</a>
            @foreach($shifts->get($day->toDateString(), collect()) as $s)
                <a class="shift {{ $s->status }} {{ $s->caregiver_id ? '' : 'open' }}" href="{{ route('admin.shifts.edit', $s) }}">
                    {{ $s->starts_at->format('g:ia') }} {{ $s->caregiver?->name ?? 'Unassigned' }}
                    <small>{{ $s->client?->name ?? $s->location }}</small>
                </a>
            @endforeach
        </div>
    @endforeach
</div>
@endsection
