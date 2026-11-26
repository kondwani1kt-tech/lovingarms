<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex, nofollow">
<title>@yield('title', 'Staff area') · Loving Arms</title>
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
@php
$nav = [
    ['admin.dashboard', 'Dashboard', 'admin.dashboard', []],
    ['admin.records.index', 'Inquiries', 'admin.records.*', ['type' => 'inquiries']],
    ['admin.records.index', 'Applications', null, ['type' => 'applications']],
    ['admin.records.index', 'Facility requests', null, ['type' => 'staffing']],
    ['admin.shifts.calendar', 'Schedule', 'admin.shifts.calendar', []],
    ['admin.shifts.index', 'Shifts', 'admin.shifts.*', []],
    ['admin.resource.index', 'Clients', null, ['resource' => 'clients']],
    ['admin.resource.index', 'Caregivers', null, ['resource' => 'caregivers']],
    ['admin.reports', 'Reports', 'admin.reports*', []],
];
@endphp
<div class="shell">
    <aside class="side">
        <a class="brand" href="{{ route('admin.dashboard') }}">♥ Loving Arms<small>Staff area</small></a>
        <nav>
            @foreach($nav as [$route, $label, $pattern, $params])
                @php $url = route($route, $params); @endphp
                <a href="{{ $url }}" class="{{ url()->current() === explode('?', $url)[0] ? 'on' : '' }}">{{ $label }}</a>
            @endforeach
            @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.staff.index') }}" class="{{ request()->routeIs('admin.staff.*') ? 'on' : '' }}">Staff logins</a>
            @endif
        </nav>
        <div class="me">
            {{ auth()->user()->name }}<br><small>{{ \App\Models\User::ROLES[auth()->user()->role] ?? auth()->user()->role }}</small>
            <form method="POST" action="{{ route('admin.logout') }}">@csrf<button class="link">Sign out</button></form>
            <a class="link" href="{{ route('home') }}" target="_blank" rel="noopener">View public site ↗</a>
        </div>
    </aside>
    <div class="main">
        <div class="top"><h1>@yield('heading')</h1><div class="actions">@yield('actions')</div></div>
        @if(session('success'))<div class="flash ok">{{ session('success') }}</div>@endif
        @if($errors->any() && ! $errors->hasAny(['name','email','role','password','new_password','caregiver_id','starts_at','ends_at']))
            <div class="flash bad">{{ $errors->first() }}</div>
        @endif
        @yield('content')
    </div>
</div>
</body>
</html>
