@extends('layouts.admin')
@section('title', 'Reports')
@section('heading', 'Reports')
@section('content')
<form class="filters" method="GET">
    <label>From <input type="date" name="from" value="{{ $from->toDateString() }}"></label>
    <label>To <input type="date" name="to" value="{{ $to->toDateString() }}"></label>
    <button class="btn">Update</button>
</form>

<div class="stats">
    <div class="stat"><b>{{ $s['inquiries']['total'] }}</b>Inquiries</div>
    <div class="stat"><b>{{ $s['applications']['total'] }}</b>Applications</div>
    <div class="stat"><b>{{ $s['staffing']['total'] }}</b>Facility requests</div>
    <div class="stat"><b>{{ $s['shifts']['total'] }}</b>Shifts</div>
</div>

<div class="grid2 top-align">
    <div class="panel">
        <h2>Pipeline by status</h2>
        @foreach([['inquiries', 'Inquiries', \App\Models\Inquiry::STATUSES], ['applications', 'Applications', \App\Models\Application::STATUSES], ['staffing', 'Facility requests', \App\Models\StaffingRequest::STATUSES]] as [$key, $label, $labels])
            <h3>{{ $label }}</h3>
            @forelse($s[$key]['by_status'] as $status => $n)
                <div class="row"><span>{{ $labels[$status] ?? $status }}</span><span>{{ $n }}</span></div>
            @empty
                <p class="muted">None in this period.</p>
            @endforelse
        @endforeach
    </div>
    <div class="panel">
        <h2>Scheduling</h2>
        @foreach($s['shifts']['by_status'] as $status => $n)
            <div class="row"><span>{{ \App\Models\Shift::STATUSES[$status] ?? $status }}</span><span>{{ $n }}</span></div>
        @endforeach
        <div class="row"><span>Shifts without a caregiver</span><span>{{ $s['shifts']['unassigned'] }}</span></div>
        <div class="row"><span>Hours completed</span><span>{{ $s['shifts']['hours_completed'] }}</span></div>
        <div class="row"><span>Hours booked</span><span>{{ $s['shifts']['hours_booked'] }}</span></div>
        <form method="POST" action="{{ route('admin.reports.email') }}" style="margin-top:16px">@csrf
            <input type="hidden" name="from" value="{{ $from->toDateString() }}"><input type="hidden" name="to" value="{{ $to->toDateString() }}">
            <button class="btn ghost">Email this report to {{ config('loving.notify_to') }}</button>
        </form>
        <p class="muted">A summary of the last 7 days is also emailed automatically every Monday.</p>
    </div>
</div>
@endsection
