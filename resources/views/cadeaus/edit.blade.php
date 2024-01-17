@section("edit")

<div id="edit-cadeau" class="modal">
    <div class="modal-content">
        <span class="closecadeaus">&times;</span>
        <h3>Aanpassen:</h3>
        <form method="POST">
            <!-- Cross site Script -->
            @csrf
            <div class="label-input">
                <label>Pas aan:</label>
                <input style="left: 0.2%;" class="input-large" name="link" placeholder="bijv: T-shirt, Schoenen" />
            </div>
            <button id="submit" class="submit">Bewerk</button>
            <button id="delete-button">Verwijder Cadeau</button>
        </form>

    </div>
</div>


<script>
    // Get the modal
    const editModal = document.getElementById("edit-cadeau");

    // Get the button that opens the modal
    const editbtn = document.getElementById("cadeau-box");

    // Get the <span> element that closes the modal
    const editspan = document.getElementsByClassName("closecadeaus")[0];

    // When the user clicks the button, open the modal
    editbtn.onclick = function() {
        editModal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    editspan.onclick = function() {
        editModal.style.display = "none";
    }
</script>




@endsection
