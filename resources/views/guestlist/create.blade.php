@section("create")
<!-- The Modal -->
<div id="create-guest" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <h3>Voeg een nieuwe gast toe:</h3>
    <form method="POST">
      <!-- Cross site Script -->
      @csrf
      <div class="name">
        <div class="label-input">
          <label for="firstname">Voornaam</label>
          <input id="firstname" class="input-name" name="firstname" placeholder="Voornaam" />
        </div>
        <div class="label-input">
          <label>Achternaam</label>
          <input class="input-name" name="lastname" placeholder="Achternaam" />
        </div>
      </div><br>
      @error('firstname')
      <p class="error">Voornaam is verplicht.</p>
      @enderror
      @error('lastname')
      <p class="error">Achternaam is verplicht.</p>
      @enderror
      <div class="label-input">
        <label for="email">Email</label>
        <input id="email" class="input-large" name="email" placeholder="Email" />
      </div><br>
      @error('email')
      <p class="error">{{$message}}</p>
      @enderror
      <div class="label-input">
        <label for="phoneNumber">Telefoonnummer</label>
        <input id="phoneNumber" class="input-large" name="phoneNumber" placeholder="Telefoonnummer" />
      </div>
      @error('phoneNumber')
      <p class="error">Telefoonnummer is verplicht.</p>
      @enderror

      <button id="submit" class="submit">Voeg toe</button>
    </form>
  </div>
</div>

<script>
  // Get the modal
  const modal = document.getElementById("create-guest");

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