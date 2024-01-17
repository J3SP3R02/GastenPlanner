@section("view")
<!-- The Modal -->
@foreach($guests as $guest)
<div id="view-guest-{{$guest->id}}" class="modal">

    <!-- Modal content -->
    <div id="view" class="modal-content">
        <span class="close">&times;</span>
        <h3>{{$guest -> firstname}} {{$guest -> lastname}}</h3>
        <form method="POST" action="/bruiloft/{unique_code}/gastenlijst" enctype="multipart/form-data">
            <!-- Cross site Script -->
            @csrf
            @method('PUT')
            <input class="" style="display: none" name="id" value="{{$guest -> id}}" />
            <div class="name">
                <div class="label-input">
                    <label for="firstname">Voornaam</label>
                    <input class="input-name" name="firstname" value="{{$guest -> firstname}}" />
                </div>
                <div class="label-input">
          <label>Achternaam</label>
                <input class="input-name" name="lastname" value="{{$guest -> lastname}}" />
                </div>
            </div>

            @error('firstname')
            <p>Voornaam is verplicht.</p>
            @enderror

            @error('lastname')
            <p>Achternaam is verplicht.</p>
            @enderror
            <div class="label-input">
        <label for="email">Email</label>
            <input class="input-large" name="email" value="{{$guest -> email}}" />
            </div>
            @error('email')
            <p>Email is verplicht.</p>
            @enderror
            <div class="label-input">
        <label for="phoneNumber">Telefoonnummer</label>
            <input class="input-large" name="phoneNumber" value="{{$guest -> phoneNumber}}" />
            </div>
            @error('phoneNumber')
            <p>Telefoonnummer is verplicht.</p>
            @enderror
            <div class="label-input">
        <label>Allergiën</label>
            <input class="input-large" name="allergies" value="{{$guest -> allergies}}" />
            </div>
            <div class="label-input">
        <label>Dieetwensen</label>
            <input class="input-large" name="dietary_wishes" value="{{$guest -> dietary_wishes}}" />
            </div>

            <button id="submit" class="submit">Pas aan</button>
        </form>

        <form method="POST">
            @csrf
            @method('DELETE')

            <input class="" style="display: none" name="id" value="{{$guest -> id}}" />
            <button class="delete">Verwijder gast</button>
        </form>
    </div>
</div>

<script>
    // Get the modal
    const viewModal{{$guest->id}} = document.getElementById("view-guest-{{$guest->id}}");

    // Get the button that opens the modal
    const viewbtn{{$guest->id}} = document.getElementById("view-button-{{$guest->id}}");

    // Get the <span> element that closes the modal
    const viewspan{{$guest->id}} = viewModal{{$guest->id}}.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal
    viewbtn{{$guest->id}}.onclick = function() {
        viewModal{{$guest->id}}.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    viewspan{{$guest->id}}.onclick = function() {
        viewModal{{$guest->id}}.style.display = "none";
    }
    
</script>
@endforeach
@endsection