@extends("layout.index")
@section('content')

<head>
    <title>Trouwplanner</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/planning.css') }}">
</head>
<div class="page">
    @include("planning.create")
    <button id="create-button">Voeg nieuwe rij toe +</button>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th id="table-left-border">Actiepunt</th>
                    <th>Wie?</th>
                    <th>Deadline</th>
                    <th id="table-right-border">Gedaan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Aankleden bruidegom</td>
                    <td>Bruidegom</td>
                    <td>26-04-2023</td>
                    <td><label>
                            <input class="checkbox" type="checkbox" />
                            <i class="fa fa-check"></i>
                        </label></td>
                </tr>
                <tr>
                    <td>Aankleden bruidegom</td>
                    <td>Bruidegom</td>
                    <td>26-04-2023</td>
                    <td><label>
                            <input class="checkbox" type="checkbox" />
                            <i class="fa fa-check"></i>
                        </label></td>
                </tr>
                <tr>
                    <td>Aankleden bruidegom</td>
                    <td>Bruidegom</td>
                    <td>26-04-2023</td>
                    <td><label>
                            <input class="checkbox" type="checkbox" />
                            <i class="fa fa-check"></i>
                        </label></td>
                </tr>
                <tr>
                    <td>Aankleden bruidegom</td>
                    <td>Bruidegom</td>
                    <td>26-04-2023</td>
                    <td><label>
                            <input class="checkbox" type="checkbox" />
                            <i class="fa fa-check"></i>
                        </label></td>
                </tr>
            </tbody>
        </table>
    </div>
    @yield('create')
</div>
<script>
    document.getElementById("pagina").innerHTML = "Trouwplanner"
</script>
@endsection