@section("create")
<!-- The Modal -->
<div id="create-seat" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <h3>Voeg een nieuwe tafel toe:</h3>
        <form method="POST">
            <!-- Cross site Script -->
            @csrf
            <div class="form-input">
                <div class="label-input">
                    <label for="table-vorm">Vorm tafel</label>
                    <input id="table-vorm" name="table-vorm" list="options-vorm" placeholder="Bijvoorbeeld rond of vierkant" class="input-large">
                    <datalist id="options-vorm">
                        <option value="Ronde tafel"></option>
                        <option value="Ovaalvormige tafel"></option>
                        <option value="Rechthoekige tafel"></option>
                        <option value="Vierkante tafel"></option>
                        <option value="Driehoek tafel"></option>
                    </datalist>
                </div><br>
                <div class="label-input">
                    <label>Aantal personen</label>
                    <input name="number" class="input-large">
                </div>
            </div>
            <button id="submit" class="submit">Voeg toe</button>
        </form>
    </div>
</div>

<script>
    // Get the modal
    const modal = document.getElementById("create-seat");

    // Get the button that opens the modal
    const btn = document.getElementById("create-table");

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