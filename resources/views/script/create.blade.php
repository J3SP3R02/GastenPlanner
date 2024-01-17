@section("create")
<!-- The Modal -->
<div id="create-script" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <h3>Voeg een nieuwe rij toe:</h3>
        <form method="POST">
            <!-- Cross site Script -->
            @csrf
            <div class="label-input">
                <label>Activiteit</label>
                <textarea style="margin-bottom: 2%;" class="input-xl" name="activity" placeholder="Activiteit"></textarea>
            </div>
            <div class="name">
                <div class="label-input">
                    <label>Begintijd</label>
                    <input type="time" name="starttime" placeholder="Begintijd" value="{{old('starttime')}}" />
                </div>
                <div class="label-input">
                    <label>Eindtijd</label>
                    <input type="time" name="endtime" placeholder="Eindtijd" />
                </div>
            </div><br>
            <div class="label-input">
                <label>Locatie</label>
                <input style="left: 0.2%;" class="input-large" name="location" placeholder="Locatie" />
            </div><br>
            <div class="label-input">
                <label>Aanwezigen</label>
                <textarea class="input-xl" name="attendees" placeholder="Aanwezigen"></textarea>
            </div>
            <button id="submit" class="submit">Voeg toe</button>
        </form>
    </div>
</div>

<script>
    // Get the modal
    const modal = document.getElementById("create-script");

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
</script>
@endsection