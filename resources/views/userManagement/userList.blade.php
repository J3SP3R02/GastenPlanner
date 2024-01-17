@section('userList')
@include('userManagement.viewUser')
<h2>Gebruikerslijst</h2>
<div class="table-container">
    <table id="users">
        <thead>
            <tr>
                <th id="table-left-border">Naam</th>
                <th>Email</th>
                <th>Telefoonnummer</th>
                <th>Gebruikersrol</th>
                <th>Code Trouwerij</th>
                <th id="table-right-border"></th>
            </tr>
        </thead>
        <tbody>

            @foreach($users as $user)
            <tr>
                <td>{{$user->firstname}} {{$user->lastname}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->phoneNumber}}</td>
                <td>{{$user->user_role}}</td>
                <td> @foreach($weddings->where('user_id', $user->id) as $wedding)
                    {{$wedding->unique_code}}<br>
                    @endforeach
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script>
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
    function sortTableUserList(column) {
        var table, rows, switching, i, x, y, shouldSwitch, sortOrder;
        table = document.getElementById("users");
        sortOrder = document.getElementById("dropdownUsers").value;
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

    function weddingCodeSort() {
        var table, rows, switching, i, x, y, shouldSwitch;
        table = document.getElementById("users");
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
                x = rows[i].getElementsByTagName("TD")[4].textContent;
                y = rows[i + 1].getElementsByTagName("TD")[4].textContent;

                // Check if the two rows should switch place:
                if (x.toLowerCase() > y.toLowerCase()) {
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
@yield('viewUser')

@endsection