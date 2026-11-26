@extends('layouts.admin')
@section('title', $c['title'])
@section('heading', $c['title'])
@section('actions')<a class="btn ghost" href="{{ request()->fullUrlWithQuery(['export' => 'csv']) }}">Export CSV</a>@endsection
@section('content')
<form class="filters" method="GET">
    <input name="q" value="{{ request('q') }}" placeholder="Search…">
    <select name="status">
        <option value="">All statuses</option>
        @foreach($statuses as $k => $l)<option value="{{ $k }}" @selected(request('status') === $k)>{{ $l }}</option>@endforeach
    </select>
    <button class="btn">Filter</button>
</form>
<div class="tablewrap">
<table>
    <thead><tr>@foreach($c['cols'] as $label)<th>{{ $label }}</th>@endforeach<th>Status</th></tr></thead>
    <tbody>
    @forelse($rows as $row)
        <tr onclick="location='{{ route('admin.records.show', ['type' => $type, 'id' => $row->id]) }}'" class="click">
            @foreach($c['cols'] as $col => $label)
                <td>@if($col === 'created_at'){{ $row->created_at->format('M j, Y g:i A') }}@else{{ \Illuminate\Support\Str::limit((string) $row->{$col}, 60) }}@endif</td>
            @endforeach
            <td><span class="chip {{ $row->status }}">{{ $statuses[$row->status] ?? $row->status }}</span></td>
        </tr>
    @empty
        <tr><td colspan="{{ count($c['cols']) + 1 }}" class="muted">Nothing here yet.</td></tr>
    @endforelse
    </tbody>
</table>
</div>
{{ $rows->links() }}
@endsection
