@extends('auth.index')
@section('content')

<head>
    <title>Registreren</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}" media="screen">
</head>
<div class="login-form">
    <h1>Registreren</h1>
    <form method="POST" onsubmit="errEmail()">
        <!-- Cross Site Script -->
        @csrf
        <div class="input-name">
            <label>
                <h3>Voornaam</h3>
            </label>
            <input id="firstname" class="login-input" name="firstname" value="{{ old('firstname') }}" />
        </div>

        <div class="input-name">
            <label>
                <h3 class="label-lastname">Achternaam</h3>
            </label>
            <input id="lastname" class="login-input" name="lastname" value="{{ old('lastname') }}" />
        </div>
        @error('firstname')
        <p class="error">Voornaam is verplicht</p>
        @enderror
        @error('lastname')
        <p class="error">Achternaam is verplicht</p>
        @enderror

        <label>
            <h3>E-mailadres</h3>
        </label>
        <input id="login-email" class="login-input" name="email" value="{{ old('email') }}" />
        @error('email')
        <p id="login-email-error" class="error">{{$message}}</p>
        @enderror

        <label>
            <h3>Telefoonnummer</h3>
        </label>
        <input class="login-input" name="phoneNumber" value="{{ old('phoneNumber') }}" />
        @error('phoneNumber')
        <p class="error">Telefoonnummer is verplicht</p>
        @enderror

        <label>
            <h3>Wachtwoord</h3>
        </label>
        <input class="login-input" name="password" type="password" />
        @error('password')
        <p class="error">{{$message}}</p>
        @enderror

        <label>
            <h3>Bevestig wachtwoord</h3>
        </label>
        <input class="login-input" name="password_confirmation" type="password" />
        <br>
        <br>

        <input class="login-checkbox" type="checkbox" name="voorwaarden">
        <label id="checkbox">Ik ga akkoord met de algemeene- en privacyvoorwaarden van Gastenplanner</label><br>
        <button class="submit">Registreren</button>
    </form>
</div>
<script>
    document.getElementById("pagina").innerHTML = "Registreren"

    function errEmail() {
        const email = document.getElementById("login-email");
        const error = document.getElementById("login-email-error");

        if (!email.value) {
            error.innerHTML = "Email is verplicht";
            return false;
        }
        return true;
    }
</script>
@endsection