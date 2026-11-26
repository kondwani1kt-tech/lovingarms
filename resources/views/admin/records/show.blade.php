@extends('layouts.admin')
@php($name = $rec->name ?? $rec->facility_name)
@section('title', $name)
@section('heading', $name)
@section('actions')<a class="btn ghost" href="{{ route('admin.records.index', ['type' => $type]) }}">← Back to list</a>@endsection
@section('content')
<div class="grid2 top-align">
    <div class="panel">
        <h2>Details</h2>
        <dl>
            @foreach($rec->getAttributes() as $key => $val)
                @continue(in_array($key, ['id', 'status', 'updated_at']) || $val === null || $val === '')
                <dt>{{ \Illuminate\Support\Str::headline($key) }}</dt>
                <dd>
                    @if($key === 'email')<a href="mailto:{{ $val }}">{{ $val }}</a>
                    @elseif($key === 'phone')<a href="tel:{{ $val }}">{{ $val }}</a>
                    @else{!! nl2br(e($val)) !!}@endif
                </dd>
            @endforeach
        </dl>
    </div>

    <div>
        <div class="panel">
            <h2>Status</h2>
            <form method="POST" action="{{ route('admin.records.status', ['type' => $type, 'id' => $rec->id]) }}" class="inline">@csrf @method('PATCH')
                <select name="status">
                    @foreach($statuses as $k => $l)<option value="{{ $k }}" @selected($rec->status === $k)>{{ $l }}</option>@endforeach
                </select>
                <button class="btn">Update</button>
            </form>
            @if($type === 'applications' && $rec->status === 'hired')
                <form method="POST" action="{{ route('admin.records.roster', ['id' => $rec->id]) }}" style="margin-top:12px">@csrf
                    <button class="btn ghost">Add to caregiver roster</button>
                </form>
            @endif
        </div>

        <div class="panel">
            <h2>Notes</h2>
            <form method="POST" action="{{ route('admin.records.note', ['type' => $type, 'id' => $rec->id]) }}">@csrf
                <textarea name="body" rows="3" placeholder="Add a note (calls made, next steps…)" required></textarea>
                @error('body')<span class="err">{{ $message }}</span>@enderror
                <button class="btn" style="margin-top:8px">Add note</button>
            </form>
            @foreach($rec->notes as $n)
                <div class="note"><small>{{ $n->user?->name ?? 'Former staff member' }} · {{ $n->created_at->format('M j, Y g:i A') }}</small><p>{!! nl2br(e($n->body)) !!}</p></div>
            @endforeach
        </div>

        @if(auth()->user()->isAdmin())
            <form method="POST" action="{{ route('admin.records.destroy', ['type' => $type, 'id' => $rec->id]) }}" onsubmit="return confirm('Delete this record permanently?')">@csrf @method('DELETE')
                <button class="btn danger">Delete record</button>
            </form>
        @endif
    </div>
</div>
@endsection
