@extends('auth.index')
@section('content')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}" media="screen">
<div class="login-form">
<h1>Wachtwoord vergeten</h1>
<form method="POST" enctype="multipart/form-data">

    <!-- Cross site Script -->
    @csrf
        <label><h3>E-mailadres</h3></label>
    <input class="login-input" name="email" />
    <br>

    <button class="submit" type="submit">Verstuur</button>
</form>
</div>

@endsection