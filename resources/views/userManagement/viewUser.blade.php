@section("viewUser")
<!-- The Modal -->
<div id="edit-user" class="modal">
    <!-- Modal content -->
    <div id="view" class="modal-content">
        <span class="close">&times;</span>
        <h3>Jan van Steen</h3>
        <form method="POST">
            <div class="name">
                <div class="label-input">
                    <label for="firstname">Voornaam </label>
                    <input class="input-name" name="firstname" value="" placeholder="Jan" />
                </div>
                <div class="label-input">
                    <label>Achternaam</label>
                    <input class="input-name" name="lastname" value="" placeholder="van Steen" />
                </div>
            </div>
            <div class="label-input">
                <label for="email">Email</label>
                <input class="input-large" name="email" value="" placeholder="jvansteen@gmail.com" />
            </div>
            <div class="label-input">
                <label for="phoneNumber">Telefoonnummer</label>
                <input class="input-large" name="phoneNumber" value="" placeholder="+31 12345678" />
            </div>
            <div class="label-input">
                <label for="weddingRole">Rol trouwerij</label>
                <select class="input-large" name="weddingRole" id="weddingRole">
                    <option value="1">Admin</option>
                    <option value="2">Bruidspaar</option>
                    <option value="3">Ceremoniemeester</option>
                    <option value="4">Weddingplanner</option>
                    <option value="5">Gast</option>
                </select>
            </div>
            <div class="label-input">
                <label for="weddingCode">Code Trouwerij</label>
                <select class="input-large" name="weddingCode" id="weddingCode">
                    <option value="1">AAA</option>
                    <option value="2">BBB</option>
                    <option value="3">CCC</option>
                </select>
            </div>


            <button id="submit" class="submit">Pas aan</button>
        </form>

        <form method="POST">
            <input class="" style="display: none" name="id" value="" />
            <button class="delete">Verwijder gast</button>
        </form>
    </div>
</div>

<script>
    // Get the modal
    const modal = document.getElementById("edit-user");

    // Get the button that opens the modal
    const btn = document.getElementById("edit-button");

    // Get the <span> element that closes the modal
    const span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

@endsection