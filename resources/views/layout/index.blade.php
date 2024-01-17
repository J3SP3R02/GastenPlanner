<head>
    <link href="{{ asset('/css/index.css')}}" rel="stylesheet" media="screen">
    <link rel="icon" type="image/x-icon" href="/images/Logo-Gastenplanner.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <img class="img" src="{{ URL::to('/') }}/images/Logo-Gastenplanner.ico" alt="" />
    <a href="/registreren"><button id="register">Registreren</button></a>
    <a href="/login"><button id="login">Inloggen</button></a>
    <div class="account">
        <img class="account-btn" src="{{ URL::to('/') }}/images/Account.png" alt="account" />
        <div class="account-dropdown">
            <form method="POST" action="/logout">
                @csrf
                <a href="#">Mijn account</a>
                <button class="plain-button" type="submit">
                    <a>Uitloggen</a>
                </button>

            </form>
        </div>
    </div>
    <div class="Navbar">
        <h1 id="pagina">Default</h1>
    </div>
    <div class="content">
        @yield('content')
    </div>
    <div class="section-buttons">
        <a href="#" id="back-button"><button class="back-button">< Vorige stap</button></a>
        <a href="#" id="next-button"><button class="next-button">Volgende stap ></button></a>
    </div>
</body>

<script>
    // Get the current path
    const currentPage = window.location.pathname;
    // console.log(currentPage.includes('gastenlijst'))
    // Set the buttons to link to the designated page
    const nextButton = document.getElementById("next-button");
    const backButton = document.getElementById("back-button");

    if (currentPage.includes('gastenlijst')) {
        nextButton.href = "/bruiloft/{{app('currentWedding')}}/locatie"
        backButton.href = '/'
    }
    if (currentPage.includes('locatie')) {
        nextButton.href = "/bruiloft/{{app('currentWedding')}}/draaiboek"
        backButton.href = "/bruiloft/{{app('currentWedding')}}/gastenlijst"
    }
    if (currentPage.includes('draaiboek')) {
        nextButton.href = "/bruiloft/{{app('currentWedding')}}/cadeautips"
        backButton.href = "/bruiloft/{{app('currentWedding')}}/locatie"
    }
    if (currentPage.includes('cadeautips')) {
        backButton.href = "/bruiloft/{{app('currentWedding')}}/draaiboek"
    }
</script>

<!-- Set this in your page and change it to your page title
    <script>
            document.getElementById("pagina").innerHTML = "page title"
    </script> -->
