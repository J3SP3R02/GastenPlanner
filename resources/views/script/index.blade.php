@extends("layout.index")
@section('content')

<head>
    <title>Draaiboek</title>
    <link rel="stylesheet" href="{{ asset('css/script.css') }}">
</head>
<div class="page">
    @include('script.create')
    @include('script.edit')
    <button id="create-button">Voeg nieuwe rij toe +</button>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th id="table-left-border">Activiteit</th>
                    <th>Tijdstip</th>
                    <th>Tijdsduur</th>
                    <th>Locatie</th>
                    <th>Aanwezigen</th>
                    <th id="table-right-border"></th>
                </tr>
            </thead>
            <tbody>
                {{-- <tr>
                    <td>Aankleden bruidegom</td>
                    <td>9.30u - 10.30u</td>
                    <td>1u</td>
                    <td>Bruidegom thuis</td>
                    <td>Bruidegom</td>
                    <td><button id="edit-button" class="editbtn">Bewerken</button></td>
                </tr>
                 <tr>
                    <td>Aankleden bruidegom</td>
                    <td>9.30u - 10.30u</td>
                    <td>1u</td>
                    <td>Bruidegom thuis</td>
                    <td>Bruidegom</td>
                    <td><button class="editbtn">Bewerken</button></td>
                </tr>
                <tr>
                    <td>Aankleden bruidegom</td>
                    <td>9.30u - 10.30u</td>
                    <td>1u</td>
                    <td>Bruidegom thuis</td>
                    <td>Bruidegom</td>
                    <td><button class="editbtn">Bewerken</button></td>
                </tr>
                <tr>
                    <td>Aankleden bruidegom</td>
                    <td>9.30u - 10.30u</td>
                    <td>1u</td>
                    <td>Bruidegom thuis</td>
                    <td>Bruidegom</td>
                    <td><button class="editbtn">Bewerken</button></td>
                </tr> --}}
                @foreach( $scripts as $data )
                    <tr id={{ $data->id }}>
                        <td>{{ $data->activity }}</td>
                        <td>{{ $data->starttime }}-{{ $data->endtime }}</td>
                        <td>{{ $data->timespan }}</td>
                        <td>{{ $data->location }}</td>
                        <td>{{ $data->attendees }}</td>
                        <td><button id="edit-button"{{ $data->id }} class="editbtn">Bewerken</button></td>
                    </tr> 
                @endforeach 
            </tbody>
        </table>
    </div>
    @yield('create')
    @yield('edit')
</div>
<script>
    document.getElementById("pagina").innerHTML = "Draaiboek"
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        } else if (event.target == editModal) {
            editModal.style.display = "none";
        }
    }
</script>
@endsection