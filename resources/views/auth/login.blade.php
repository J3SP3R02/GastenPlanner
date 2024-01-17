@extends('auth.index')
@section('content')

<head>
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}" media="screen">
</head>
<div class="login-form">
    <h1>Inloggen</h1>
    <form method="POST">

        <!-- Cross site Script -->
        @csrf
        <label>
            <h3>E-mailadres</h3>
        </label>
        <input class="login-input" name="email" />
        <br>
        <label>
            <h3>Wachtwoord</h3>
        </label>
        <input class="login-input" name="password" type="password" />
        <br><br>

        <input class="login-checkbox" type="checkbox" name="remember-password">
        <label id="checkbox">Onthoud mij</label><br>

        <button>Inloggen</button>
        <a href="/forgot-password"><button class="submit" id="reset-password" type="button">Wachtwoord Vergeten</button></a>
    </form>
</div>
@endsection