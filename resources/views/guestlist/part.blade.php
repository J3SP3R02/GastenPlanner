  @section("part")
  <!-- The Modal -->
  <div id="create-part" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
      <span class="close">&times;</span>
      <h3>Voeg een onderdeel van de dag toe:</h3>
      <form method="POST" action="gastenlijst/welcome_role" enctype="multipart/form-data">
        <!-- Cross site Script -->
        @csrf
        @method('PUT')
          <div class="label-input">
            <label>Onderdeel dag</label>
            <input class="input-large" name="moment_welcome_1" placeholder="bijvoorbeeld: avond" />
          </div>

          <div class="label-input">
              <label>Onderdeel dag</label>
              <input class="input-large" name="moment_welcome_2" placeholder="bijvoorbeeld: avond" />
          </div>

          <div class="label-input">
              <label>Onderdeel dag</label>
              <input class="input-large" name="moment_welcome_3" placeholder="bijvoorbeeld: avond" />
          </div>

          <div class="label-input">
              <label>Onderdeel dag</label>
              <input class="input-large" name="moment_welcome_4" placeholder="bijvoorbeeld: avond" />
          </div>

        <button id="submit" class="submit">Voeg toe</button>
      </form>
    </div>
  </div>

  <script>
    // Get the modal
    const partModal = document.getElementById("create-part");

    // Get the button that opens the modal
    const partbtn = document.getElementById("create-part-button");

    // Get the <span> element that closes the modal
    const partspan = partModal.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal
    partbtn.onclick = function() {
      partModal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    partspan.onclick = function() {
      partModal.style.display = "none";
    }

  </script>
  @endsection
