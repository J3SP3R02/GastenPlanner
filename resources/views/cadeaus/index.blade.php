@extends("layout.index")
@section('content')

<head>
    <title>Cadeautips</title>
    <link rel="stylesheet" href="{{ asset('css/cadeaus.css') }}">
</head>
<div class="page">
    @include("cadeaus.create")
    @include("cadeaus.edit")

    <form method="POST" action="/get-access-token">
        @csrf
        <button type="submit">
            test apicrden
        </button>
    </form>

    <button id="create-button">Voeg cadeau toe +</button>
    <table>

        <form>
            <label for="dropdown"></label>
            <select class="dropdown" name="dropdown">
                <option value="optie1">Sorteren op</option>
                <option value="low-to-high">Prijs: laag naar hoog</option>
                <option value="high-to-low">Prijs: hoog naar laag</option>
                <option value="a-to-z">Naam: A tot Z</option>
                <option value="z-to-a">Naam: Z tot A</option>
            </select>
        </form>
        <div class="cadeau">
            <div id="cadeau-box" class="cadeau-box" data-price="25">
                <img class="cadeau-img" src="{{ URL::to('/') }}/images/Techmerecadeautje.jpg" alt="" />
                <h3>Ringen</h3>
                <p class="price">€25</p>
                <label>
                    <input class="checkbox" type="checkbox" />
                    <i class="fa fa-check"></i>
                </label>
            </div>
            <div class="cadeau-box" data-price="30">
                <img class="cadeau-img" src="{{ URL::to('/') }}/images/Techmerecadeautje.jpg" alt="" />
                <h3>T-Shirt</h3>
                <p class="price">€30</p>
                <label>
                    <input class="checkbox" type="checkbox" />
                    <i class="fa fa-check"></i>
                </label>
            </div>
            <div class="cadeau-box" data-price="40">
                <img class="cadeau-img" src="{{ URL::to('/') }}/images/Techmerecadeautje.jpg" alt="" />
                <h3>Bloemen</h3>
                <p class="price">€40</p>
                <label>
                    <input class="checkbox" type="checkbox" />
                    <i class="fa fa-check"></i>
                </label>
            </div>
            <div class="cadeau-box" data-price="50">
                <img class="cadeau-img" src="{{ URL::to('/') }}/images/Techmerecadeautje.jpg" alt="" />
                <h3>Geld</h3>
                <p class="price">€50</p>
                <label>
                    <input class="checkbox" type="checkbox" />
                    <i class="fa fa-check"></i>
                </label>
            </div>
            <div class="cadeau-box" data-price="60">
                <img class="cadeau-img" src="{{ URL::to('/') }}/images/Techmerecadeautje.jpg" alt="" />
                <h3>Playstation</h3>
                <p class="price">€60</p>
                <label>
                    <input class="checkbox" type="checkbox" />
                    <i class="fa fa-check"></i>
                </label>
            </div>
            <div class="cadeau-box" data-price="70">
                <img class="cadeau-img" src="{{ URL::to('/') }}/images/Techmerecadeautje.jpg" alt="" />
                <h3>Telefoon</h3>
                <label>
                    <p class="price">€70</p>
                    <input class="checkbox" type="checkbox" />
                    <i class="fa fa-check"></i>
                </label>
            </div>
            <div class="cadeau-box" data-price="80">
                <img class="cadeau-img" src="{{ URL::to('/') }}/images/Techmerecadeautje.jpg" alt="" />
                <h3>Tas</h3>
                <label>
                    <p class="price">€80</p>
                    <input class="checkbox" type="checkbox" />
                    <i class="fa fa-check"></i>
                </label>
            </div>
            <div class="cadeau-box" data-price="90">
                <img class="cadeau-img" src="{{ URL::to('/') }}/images/Techmerecadeautje.jpg" alt="" />
                <h3>TV</h3>
                <label>
                    <p class="price">€90</p>
                    <input class="checkbox" type="checkbox" />
                    <i class="fa fa-check"></i>
                </label>
            </div>
        </div>
        @yield("create")
        @yield("edit")
        <script>
            document.getElementById("pagina").innerHTML = "Cadeautips"

            const dropdown = document.querySelector('.dropdown');
            dropdown.addEventListener('change', sortCadeauBox);

            function sortCadeauBox() {
                const cadeauBoxes = document.querySelectorAll('.cadeau-box');
                let sortedBoxes;

                if (dropdown.value === 'low-to-high') {
                    sortedBoxes = Array.from(cadeauBoxes).sort(comparePricesLowToHigh);
                } else if (dropdown.value === 'high-to-low') {
                    sortedBoxes = Array.from(cadeauBoxes).sort(comparePricesHighToLow);
                } else if (dropdown.value === 'a-to-z') {
                    sortedBoxes = Array.from(cadeauBoxes).sort(compareNamesAToZ);
                } else if (dropdown.value === 'z-to-a') {
                    sortedBoxes = Array.from(cadeauBoxes).sort(compareNamesZToA);
                }

                const cadeauContainer = document.querySelector('.cadeau');
                sortedBoxes.forEach(box => cadeauContainer.appendChild(box));
            }

            function comparePricesLowToHigh(boxA, boxB) {
                const priceA = parseFloat(boxA.dataset.price);
                const priceB = parseFloat(boxB.dataset.price);
                if (priceA < priceB) {
                    return -1;
                } else if (priceA > priceB) {
                    return 1;
                } else {
                    return 0;
                }
            }

            function comparePricesHighToLow(boxA, boxB) {
                const priceA = parseFloat(boxA.dataset.price);
                const priceB = parseFloat(boxB.dataset.price);
                if (priceA < priceB) {
                    return 1;
                } else if (priceA > priceB) {
                    return -1;
                } else {
                    return 0;
                }
            }

            function compareNamesAToZ(boxA, boxB) {
                const nameA = boxA.querySelector('h3').textContent.toLowerCase();
                const nameB = boxB.querySelector('h3').textContent.toLowerCase();
                if (nameA < nameB) {
                    return -1;
                } else if (nameA > nameB) {
                    return 1;
                } else {
                    return 0;
                }
            }

            function compareNamesZToA(boxA, boxB) {
                const nameA = boxA.querySelector('h3').textContent.toLowerCase();
                const nameB = boxB.querySelector('h3').textContent.toLowerCase();
                if (nameA < nameB) {
                    return 1;
                } else if (nameA > nameB) {
                    return -1;
                } else {
                    return 0;
                }
            }

            //Stops opening the modal when clicking on the checkbox
            const checkboxes = document.querySelectorAll('.checkbox');
            checkboxes.forEach((checkbox) => {
                checkbox.addEventListener('click', (event) => {
                    event.stopPropagation();
                });

                const icons = checkbox.parentNode.querySelectorAll('i');
                icons.forEach((icon) => {
                    icon.addEventListener('click', (event) => {
                        event.stopPropagation();
                    });
                });

                checkbox.addEventListener('change', (event) => {
                    if (event.target.checked) {
                        event.stopPropagation();
                    }
                    const checkboxParent = checkbox.closest('.cadeau-box');
                    checkboxParent.classList.toggle('checked');
                });
            });

            //Closes the modal when clicked outside the modal
            // window.onclick = function(event) {
            //     if (event.target == modal) {
            //         modal.style.display = "none";
            //     } else if (event.target == editModal) {
            //         editModal.style.display = "none";
            //     }
            // }
        </script>
        @endsection
