@section("edit")
<!-- The Modal -->
<div id="edit-script" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <h3>Bewerk een rij:</h3>
        <form>
            <!-- Cross site Script -->
            @csrf
            <div class="label-input">
                <label>Activiteit</label>
                <textarea style="margin-bottom: 2%;" class="input-xl" name="activity" placeholder="Aankleden bruidegrom"></textarea>
            </div>
            <div class="name">
                <div class="label-input">
                    <label>Begintijd</label>
                    <input type="time" name="starttime" placeholder="9.30" value="{{old('starttime')}}" />
                </div>
                <div class="label-input">
                    <label>Eindtijd</label>
                    <input type="time" name="endtime" placeholder="10.30" />
                </div>
            </div><br>
            <div class="label-input">
                <label>Locatie</label>
                <input style="left: 0.2%;" class="input-large" name="location" placeholder="Bruidegom thuis" />
            </div><br>
            <div class="label-input">
                <label>Aanwezigen</label>
                <textarea class="input-xl" name="attendees" placeholder="Bruidegom"></textarea>
            </div>
            <button id="submit" class="submit">Bewerk</button>
            <button class="delete">Verwijderen</button>
        </form>
    </div>
</div>

<script>
    // Get the modal
    const editModal = document.getElementById("edit-script");

    // Get the button that opens the modal
    const editbtn = document.getElementById("edit-button");

    // Get the <span> element that closes the modal
    const editspan = document.getElementsByClassName("close")[1];

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