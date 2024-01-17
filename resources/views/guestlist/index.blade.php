@extends('layout.index')
@section('content')

<head>
    <title>Gastenlijst</title>
    <link rel="stylesheet" href="{{ asset('css/guestlist.css') }}">
</head>
<div class="page">
    <div class="container">
        @include('guestlist.create')
        @include('guestlist.view')
        @include('guestlist.part')
        <form action="gastenlijst/export">
            <button type="submit" style="margin-top: 15%;">Export</button>
        </form>
        <button id="create-button" data-target="create-guest">Voeg nieuwe gast toe +</button>
        <button id="create-part-button" data-target="create-part">Voeg onderdeel dag toe +</button>
        <form>
            <label for="dropdown"></label>
            <select class="dropdown" name="dropdown" id="dropdown" onchange="sortTable()">
                <option value="optie1">Sorteren op</option>
                <option value="optie2">Naam (A-Z)</option>
                <option value="optie3">Naam Z-A</option>
            </select>
        </form>
    </div>
    <div class="page-table">
        <div class="table-split" style="border-bottom: 2px solid #A3DDCB;">
            <table>
                <thead>
                    <tr style="border-right: 2px solid #A3DDCB;">
                        <th>Naam Gast</th>
                        @foreach($welcome_role as $role)
                        <th>{{$role->moment_welcome_1}}</th>
                        <th>{{$role->moment_welcome_2}}</th>
                        <th>{{$role->moment_welcome_3}}</th>
                        <th>{{$role->moment_welcome_4}}</th>
                        @endforeach
                    </tr>
                    <tr id="col2">
                        <th>Naam Gast</th>
                        @foreach($welcome_role as $role)
                        <th>{{$role->moment_welcome_1}}</th>
                        <th>{{$role->moment_welcome_2}}</th>
                        <th>{{$role->moment_welcome_3}}</th>
                        <th>{{$role->moment_welcome_4}}</th>
                        @endforeach
                    </tr>
                </thead>
            </table>
        </div>
        <form method="POST" action="gastenlijst/welcome_role">
            @csrf
            <div class="table-split">
                <table id="guest-table">
                    <tr style="display: none;"></tr>
                    @foreach($guests as $guest)
                    <tr>
                        <td id="view-button-{{ $guest->id }}" data-target="view-guest-{{ $guest->id }}">{{ $guest->firstname }} {{ $guest->lastname }}</td>
                        @foreach($welcome_role as $role)
                        @if ($role->moment_welcome_1)
                        <td><label>
                                <input class="checkbox" type="checkbox" name="guests[{{$guest->id}}][moment_welcome_1]" value="1" {{ $guest->moment_welcome_1 ? 'checked' : '' }}>
                                <i class="fa fa-check"></i>
                            </label></td>
                        @else <td class="hidden-chechbox">
                            <p></p>
                        </td>
                        @endif
                        @if ($role->moment_welcome_2)
                        <td><label>
                                <input class="checkbox" type="checkbox" name="guests[{{$guest->id}}][moment_welcome_2]" value="1" {{ $guest->moment_welcome_2 ? 'checked' : '' }}>
                                <i class="fa fa-check"></i>
                            </label></td>
                        @else <td>
                            <p></p>
                        </td>
                        @endif
                        @if ($role->moment_welcome_3)
                        <td><label>
                                <input class="checkbox" type="checkbox" name="guests[{{$guest->id}}][moment_welcome_3]" value="1" {{ $guest->moment_welcome_3 ? 'checked' : '' }}>
                                <i class="fa fa-check"></i>
                            </label></td>
                        @else <td>
                            <p></p>
                        </td>
                        @endif
                        @if ($role->moment_welcome_4)
                        <td><label>
                                <input class="checkbox" type="checkbox" name="guests[{{$guest->id}}][moment_welcome_4]" value="1" {{ $guest->moment_welcome_4  ? 'checked' : ''}}>
                                <i class="fa fa-check"></i>
                            </label></td>
                        @else <td class="hidden-chechbox">
                            <p></p>
                        </td>
                        @endif
                        @endforeach
                    </tr>
                    @endforeach
                </table>
            </div>
            <button class="save-checkbox" id="savecheckboxes">Opslaan</button>
        </form>

    </div>
</div>
@yield('create')
@yield('view')
@yield('part')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    jQuery(document).ready(function() {
        document.getElementById("pagina").innerHTML = "Gastenlijst"
    });
    // Get all the modals
    const modals = document.getElementsByClassName("modal");

    // When the user clicks anywhere outside the modal, close it
    window.onclick = function(event) {
        for (let i = 0; i < modals.length; i++) {
            if (event.target === modals[i]) {
                modals[i].style.display = "none";
            }
        }
    }

    function sortTable() {
        var table, rows, switching, i, x, y, shouldSwitch, sortOrder;
        table = document.getElementById("guest-table");
        sortOrder = document.getElementById("dropdown").value;
        switching = true;
        /*Make a loop that will continue until
        no switching has been done:*/
        while (switching) {
            //start by saying: no switching is done:
            switching = false;
            rows = table.rows;
            /*Loop through all table rows (except the
            first, which contains table headers):*/
            for (i = 1; i < (rows.length - 1); i++) {
                //start by saying there should be no switching:
                shouldSwitch = false;
                /*Get the two elements you want to compare,
                one from current row and one from the next:*/
                x = rows[i].getElementsByTagName("TD")[0].textContent.split(" ")[1];
                y = rows[i + 1].getElementsByTagName("TD")[0].textContent.split(" ")[1];
                //check if the two rows should switch place:

                if (sortOrder == "optie2") {
                    if (x.toLowerCase() > y.toLowerCase()) {
                        //if so, mark as a switch and break the loop:
                        shouldSwitch = true;
                        break;
                    }
                } else if (sortOrder == "optie3") {
                    if (x.toLowerCase() < y.toLowerCase()) {
                        //if so, mark as a switch and break the loop:
                        shouldSwitch = true;
                        break;
                    }
                }
            }
            if (shouldSwitch) {
                /*If a switch has been marked, make the switch
                and mark that a switch has been done:*/
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
            }
        }
    }
</script>
@endsection