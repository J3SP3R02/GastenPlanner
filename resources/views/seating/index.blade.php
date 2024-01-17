@extends("layout.index")
@section('content')
@include("seating.create")

<head>
    <title>Seating</title>
    <link rel="stylesheet" href="{{ asset('css/seating.css') }}">
    <script src="https://kit.fontawesome.com/f2ff931b2e.js" crossorigin="anonymous"></script>
</head>
<div class="page">
    <div class="box"></div>
    <button id="create-table" class="new-table">
        <p>Nieuwe tafel<i class="fa-thin fa-plus"></i></p>
    </button>
</div>
<script>
    document.getElementById("pagina").innerHTML = "Seating"
</script>
@yield('create')
@endsection