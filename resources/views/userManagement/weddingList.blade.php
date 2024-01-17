@section('weddingList')
<script>
    function searchBarWeddingList() {
        var input, filter, table, tr, td, i, j, txtValue;
        input = document.getElementById("queryWeddingList");
        filter = input.value.toUpperCase();
        table = document.getElementById("weddings");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            if (i === 0) {
                // Skip the first row (header row)
                continue;
            }

            td = tr[i].getElementsByTagName("td");
            var match = false;
            for (j = 0; j < td.length; j++) {
                if (td[j]) {
                    txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        match = true;
                        break;
                    }
                }
            }
            if (match) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }

    function searchBarUserList() {
        var input, filter, table, tr, td, i, j, txtValue;
        input = document.getElementById("queryUserList");
        filter = input.value.toUpperCase();
        table = document.getElementById("users");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            if (i === 0) {
                // Skip the first row (header row)
                continue;
            }

            td = tr[i].getElementsByTagName("td");
            var match = false;
            for (j = 0; j < td.length; j++) {
                if (td[j]) {
                    txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        match = true;
                        break;
                    }
                }
            }
            if (match) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
    //Sort Function
    function sortTableWeddingList() {
        var table, rows, switching, i, x, y, shouldSwitch, sortOrder;
        table = document.getElementById("weddings");
        sortOrder = document.getElementById("dropdownWeddings").value;
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
                x = rows[i].getElementsByTagName("TD")[2].textContent.split(" ")[1];
                y = rows[i + 1].getElementsByTagName("TD")[2].textContent.split(" ")[1];
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

    function dateSort() {
        var table, rows, switching, i, x, y, shouldSwitch;
        table = document.getElementById("weddings");
        switching = true;

        /* Make a loop that will continue until
        no switching has been done: */
        while (switching) {
            // Start by saying no switching is done:
            switching = false;
            rows = table.rows;

            /* Loop through all table rows (except the
            first, which contains table headers): */
            for (i = 1; i < (rows.length - 1); i++) {
                // Start by saying there should be no switching:
                shouldSwitch = false;

                /* Get the two elements you want to compare,
                one from the current row and one from the next: */
                x = rows[i].getElementsByTagName("TD")[1].textContent;
                y = rows[i + 1].getElementsByTagName("TD")[1].textContent;

                // Convert the date strings to Date objects for comparison:
                var dateXParts = x.split("-");
                var dateYParts = y.split("-");
                var dateX = new Date(dateXParts[2], dateXParts[1] - 1, dateXParts[0]);
                var dateY = new Date(dateYParts[2], dateYParts[1] - 1, dateYParts[0]);

                // Check if the two rows should switch place:
                if (dateX < dateY) {
                    // If so, mark as a switch and break the loop:
                    shouldSwitch = true;
                    break;
                }
            }

            if (shouldSwitch) {
                /* If a switch has been marked, make the switch
                and mark that a switch has been done: */
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
            }
        }
    }
</script>

<body>
    <h2>Weddinglijst</h2>
    <div class="table-container">
        <table id="weddings">
            <thead>
                <tr>
                    <th id="table-left-border">Weddingcode</th>
                    <th>Datum</th>
                    <th>Gebruiker</th>
                    <th>Link Pagina</th>
                    <th id="table-right-border"></th>
                </tr>
            </thead>
            <tbody>
            @foreach($weddings as $wedding)
                <tr>
                    <td>{{$wedding->unique_code}}</td>
                    <td>{{$wedding->date}}</td>
                    @foreach($users->where('id', $wedding->user_id) as $user)
                        <td>{{$user->firstname}} {{$user->lastname}}</td>
                    @endforeach
                    <td><a href="/bruiloft/{{$wedding->unique_code}}/gastenlijst"><button class="table-buttons">Naar Pagina</button></a></td>
                    <td>
                        <form method="POST">
                            @csrf
                            @method('DELETE')

                                <input name="id" style="display: none" value="{{$wedding->id}}"/>
                                <button>Verwijder</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</body>

@endsection
