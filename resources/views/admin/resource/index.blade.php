@extends('layouts.admin')
@section('title', $c['title'])
@section('heading', $c['title'])
@section('actions')<a class="btn" href="{{ route('admin.resource.create', ['resource' => $resource]) }}">+ Add {{ $c['singular'] }}</a>@endsection
@section('content')
<form class="filters" method="GET"><input name="q" value="{{ request('q') }}" placeholder="Search by name…"><button class="btn">Search</button></form>
<div class="tablewrap">
<table>
    <thead><tr>@foreach($c['cols'] as $col)<th>{{ $c['fields'][$col][0] === 'Active' || str_starts_with($c['fields'][$col][0], 'Active') ? 'Active' : $c['fields'][$col][0] }}</th>@endforeach</tr></thead>
    <tbody>
    @forelse($rows as $row)
        <tr class="click" onclick="location='{{ route('admin.resource.edit', ['resource' => $resource, 'id' => $row->id]) }}'">
            @foreach($c['cols'] as $col)
                <td>@if($col === 'is_active'){{ $row->is_active ? '✓' : '—' }}@else{{ $row->{$col} }}@endif</td>
            @endforeach
        </tr>
    @empty
        <tr><td colspan="{{ count($c['cols']) }}" class="muted">Nothing here yet.</td></tr>
    @endforelse
    </tbody>
</table>
</div>
{{ $rows->links() }}
@endsection
