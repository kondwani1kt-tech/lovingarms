<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex, nofollow">
<title>Staff sign in · Loving Arms</title>
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="login">
<form class="card" method="POST" action="{{ route('admin.login') }}">@csrf
    <div class="brand-big">♥ Loving Arms<small>Staff sign in</small></div>
    @include('partials.field', ['name' => 'email', 'label' => 'Email', 'type' => 'email', 'required' => true, 'full' => true])
    @include('partials.field', ['name' => 'password', 'label' => 'Password', 'type' => 'password', 'required' => true, 'full' => true])
    <button class="btn" type="submit">Sign in</button>
    <p class="muted">Access is limited to Loving Arms staff. Ask an administrator if you need an account.</p>
</form>
</body>
</html>
