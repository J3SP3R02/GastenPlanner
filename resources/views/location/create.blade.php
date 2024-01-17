@section("create")
<!-- The Modal -->
<div id="create-location" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <h3>Voeg een nieuwe bruiloft locatie toe:</h3>
        <form method="POST">
            <!-- Cross site Script -->
            @csrf
            <div class="label-input">
                <label>Straatnaam</label>
                <input style="left: 0.2%;" class="input-large" name="link" placeholder="Straatnaam" />
            </div><br>
            <div class="name">
                <div class="label-input">
                    <label>Huisnummer</label>
                    <input class="input-small" name="link" placeholder="Huisnummer" />
                </div>
                <div class="label-input">
                    <label>Postcode</label>
                    <input class="input-small" name="link" placeholder="Postcode" />
                </div>
            </div><br>
            <div class="label-input">
                <label>Plaats</label>
                <input style="left: 0.2%;" class="input-large" name="link" placeholder="Plaats" />
            </div>
            <button id="submit" class="submit">Voeg toe</button>
            <button id="delete-button">Verwijder Locatie</button>
        </form>
    </div>
</div>

<script>
    // Get the modal
    const modal = document.getElementById("create-location");

    // Get all locatie-box elements
    const locatieBoxes = document.querySelectorAll(".locatie-box");

    // Get the <span> element that closes the modal
    const span = document.getElementsByClassName("close")[0];

    // When the user clicks on a locatie-box, open the modal
    locatieBoxes.forEach(function(locatieBox) {
        locatieBox.onclick = function() {
            modal.style.display = "block";
        };
    });

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    };

    // When the user clicks anywhere outside the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };
</script>
@endsection

