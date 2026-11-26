@extends('layouts.admin')
@section('title', ($item ? 'Edit ' : 'Add ').$c['singular'])
@section('heading', ($item ? 'Edit ' : 'Add ').$c['singular'])
@section('actions')<a class="btn ghost" href="{{ route('admin.resource.index', ['resource' => $resource]) }}">← Back</a>@endsection
@section('content')
<form class="panel formgrid" method="POST" action="{{ $item ? route('admin.resource.update', ['resource' => $resource, 'id' => $item->id]) : route('admin.resource.store', ['resource' => $resource]) }}">
    @csrf
    @if($item) @method('PUT') @endif
    <div class="fields">
        @foreach($c['fields'] as $name => $f)
            @if($f[1] === 'checkbox')
                <div class="field full"><label class="check"><input type="checkbox" name="{{ $name }}" value="1" @checked(old($name, $item ? $item->{$name} : true))><span>{{ $f[0] }}</span></label></div>
            @else
                @include('partials.field', [
                    'name' => $name, 'label' => $f[0], 'type' => $f[1], 'full' => true,
                    'required' => str_starts_with($f[2], 'required'), 'options' => $f[3] ?? [],
                    'value' => $item ? $item->{$name} : '',
                ])
            @endif
        @endforeach
    </div>
    <button class="btn">Save</button>
</form>
@if($item && auth()->user()->isAdmin())
    <form method="POST" action="{{ route('admin.resource.destroy', ['resource' => $resource, 'id' => $item->id]) }}" onsubmit="return confirm('Delete this {{ $c['singular'] }}?')">@csrf @method('DELETE')
        <button class="btn danger">Delete {{ $c['singular'] }}</button>
    </form>
@endif
@endsection
