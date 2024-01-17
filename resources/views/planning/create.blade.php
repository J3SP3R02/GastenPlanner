@section("create")
<!-- The Modal -->
<div id="create-planning" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <h3>Voeg een nieuwe rij toe:</h3>
        <form method="POST">
            <!-- Cross site Script -->
            @csrf
            <div class="label-input">
                <label>Actiepunt</label>
                <textarea style="margin-bottom: 2%;" class="input-xl" name="actionpoint" placeholder="Actiepunt"></textarea>
            </div>
                <div class="label-input">
                    <label>Wie?</label>
                    <input class="input-large" name="who" placeholder="Wie" />
                </div><br>
                <div class="label-input">
                    <label>Deadline</label>
                    <input class="input-large" name="deadline" placeholder="Deadline" />
                </div>
                <button id="submit" class="submit">Voeg toe</button>
        </form>
    </div>
</div>

<script>
    // Get the modal
    const modal = document.getElementById("create-planning");

    // Get the button that opens the modal
    const btn = document.getElementById("create-button");

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