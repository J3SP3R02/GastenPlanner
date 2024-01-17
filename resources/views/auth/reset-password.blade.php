@extends('auth.index')
@section('content')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}" media="screen">
<div class= "login-form">
<h1>Wachtwoord resetten</h1>
<form method="POST" enctype="multipart/form-data" action="/reset-password">

    <!-- Cross site Script -->
    @csrf
    <label><h3>E-mailadres</h3></label>
    <input class="login-input" name="email" />
    <br>

    <label><h3>Wachtwoord</h3></label>
    <input class="login-input" name="password" type="password"/>
    @error('password')
    <p class="error">{{$message}}</p>
    @enderror

    <label><h3>Bevestig wachtwoord</h3></label>
    <input class="login-input" name="password_confirmation" type="password"/>
    <br>
    <br>

    <input id="invisible_id" name="token" type="hidden" value="{{ $token }}">

    <button>Verstuur</button>
</form>
</div>

@endsection