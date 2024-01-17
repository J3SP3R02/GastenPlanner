<head>
    <link href="{{ URL::to('/css/index.css')}}" rel="stylesheet" media="screen">
    <link rel="icon" type="image/x-icon" href="/images/Logo-Gastenplanner.ico">
</head>

<body>
    <img class="img" src="{{ URL::to('/') }}/images/Logo-Gastenplanner.ico" alt="" />
    <div class="nav-buttons">
        <a href="/registreren"><button id="register">Registreren</button></a>
        <a href="/login"><button id="login">Inloggen</button></a>
    </div>
    <div class="content">
        <img src="{{ URL::to('/') }}/images/Login-Ringen.png" alt="ringen"/>
        @yield('content')
    </div>
</body>