@section("create")
<!-- The Modal -->
<div id="create-cadeau" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <h3>Voeg uw cadeau link toe:</h3>
        <form id="add_cadeau" method="POST">
            <!-- Cross site Script -->
            @csrf
            <div class="label-input">
                <label>URL</label>
                <input style="left: 0.2%;" class="input-large" name="query" placeholder="Https://..." type="text" />
            </div>
            <button id="submit" class="submit" type="submit">Voeg toe</button>
        </form>
    </div>
</div>

<script>
    // Get the modal
    const modal = document.getElementById("create-cadeau");

    // Get the button that opens the modal
    const btn = document.getElementById("create-button");

    // Get the <span> element that closes the modal
    const span = document.getElementsByClassName("close")[0];

    // Get the form element
    const form = document.getElementById("add_cadeau");

    // When the user clicks the button, open the modal
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    function handleForm(event) {
        event.preventDefault();

        // Get the form data
        const formData = new FormData(form);

        // Perform the AJAX request
        const xhr = new XMLHttpRequest();
        xhr.open(form.method, form.action);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                // Handle the successful response
                console.log(xhr.responseText);
            } else {
                // Handle any errors or other responses
            }
        };
        xhr.send(formData);
    }

    // Attach the event listener to the form's submit event
    form.addEventListener('submit', handleForm);
</script>
</div>
@endsection