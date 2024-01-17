@extends("layout.index")
@section('content')

<!DOCTYPE html>
<html>
<head>
    <title>Locatie</title>
    <style>
        .map {
            height: 350px;
            width: 25%;
            border: 2px solid red;
            margin-bottom: 20px;
            margin-right: 20px;
        }

        .map-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            justify-content: flex-start;
        }

        .location-button {
            display: none;
            margin-top: 20px;
        }

        .location-button-container {
            display: flex;
            flex-direction: column;
        }
    </style>
</head>

<body>
<div class="map-container">
    <div>
        <form name="myform" method="POST">
            @csrf
            <label for="address_address">Address</label>
            <input type="text" id="address-input" name="address_address" class="form-control map-input">
            <input type="hidden" name="address_latitude" id="address-latitude" value="0" />
            <input type="hidden" name="address_longitude" id="address-longitude" value="0" />

            <button>submit</button>
        </form>

        <script>

            //Changes the value of the lat & lng value
            function changeValue(event) {
                event.preventDefault(); // Prevent default form submission behavior

                const addressValue = document.myform.address_address.value;

                geocodeAddress(addressValue)
                    .then(({ latValue, lngValue }) => {
                        setLocationCoordinates(latValue, lngValue);
                        console.log('Input value updated successfully');

                        // Manually trigger form submission
                        document.myform.submit();
                    })
                    .catch(error => {
                        console.error('Error occurred:', error);
                    });
            }


            function geocodeAddress(address) {
                return new Promise((resolve, reject) => {

                    //Get the longitude & latitude value from the address
                    let geocoder = new google.maps.Geocoder();
                    geocoder.geocode({ address: address }, function(res, status) {
                        if (status === 'OK' && res.length > 0) {
                            let latValue = res[0].geometry.location.lat();
                            let lngValue = res[0].geometry.location.lng();
                            resolve({ latValue, lngValue });
                        } else {
                            reject(new Error('Geocoding failed'));
                        }
                    });
                });
            }


            function setLocationCoordinates(latValue, lngValue) {
                document.myform.address_latitude.value = latValue;
                document.myform.address_longitude.value = lngValue;
            }

            // Add event listener to the form submission
            document.myform.addEventListener('submit', changeValue);

        </script>
    </div>

{{--  google maps api with key from the .env, callback loadGoogleMaps renders all the maps in last  --}}
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCpY2-mjGfJOet8-iDioJr9I8yTA8_YkOI&callback=loadGoogleMaps" async defer></script>

{{-- make a div for every map; unique with the primary key from the row --}}
    @foreach($locations as $location)
        <div class="map" id="map_{{$location->id}}"></div>

        <div class="location-button-container">
            @if ($location->address_latitude != 0 && $location->address_longitude != 0)
                <button class="location-button" id="location-button_{{$location->id}}" onclick="openModal()">Locatie</button>
            @endif
        </div>
    @endforeach

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
        <form>
             <!-- Cross site Script -->
             @csrf
            <div class="label-input">
                <label>Straatnaam</label>
                <input style="left: 0.2%;" class="input-large" name="link" placeholder="bijv: Grotemarkt" />
            </div><br>
            <div class="name">
                <div class="label-input">
                    <label>Huisnummer</label>
                    <input class="input-small" name="link" placeholder="bijv: 12" />
                </div>
                <div class="label-input">
                    <label>Postcode</label>
                    <input class="input-small" name="link" placeholder="Bijv 1232 JK" />
                </div>
            </div><br>
            <div class="label-input">
                <label>Plaats</label>
                <input style="left: 0.2%;" class="input-large" name="link" placeholder="bijv: Almere" />
            </div>
            <button id="submit" class="submit">Pas aan</button>
            <button id="delete-button">Verwijder</button>
        </form>
    </div>
</div>
        </div>

    <script>
        //Get all locations from the current wedding from the DB
        let locations = @json($locations);

        // Loop through all coordinates
        function loadGoogleMaps() {
            locations.forEach(function (item) {
                console.log('map_' + item.id);
                console.log(item);
                initMap(item.address_latitude, item.address_longitude, item.address_address, item.id);
            });
            showLocationButtons(); // Call the function to show the buttons after maps are loaded
        }

        function initMap(latValue, lngValue, address, id) {

            //Make new map, get the div with the primary key from the coordinates
            let map = new google.maps.Map(document.getElementById('map_' + id), {
                zoom: 15,
                center: {lat: parseFloat(latValue), lng: parseFloat(lngValue)}
            });

            //Make marker for the map
            let marker = new google.maps.Marker({
                position: {lat: parseFloat(latValue), lng: parseFloat(lngValue)},
                map: map,
                title: address,
            });
        }

        function showLocationButtons() {
            locations.forEach(function (item) {
                if (item.address_latitude != 0 && item.address_longitude != 0) {
                    const locationButton = document.getElementById('location-button_' + item.id);
                    locationButton.style.display = 'block';
                }
            });
        }

        function openModal() {
            document.getElementById("myModal").style.display = "block";
        }

        function closeModal() {
            document.getElementById("myModal").style.display = "none";
        }
    </script>
</body>
</html>
@endsection
