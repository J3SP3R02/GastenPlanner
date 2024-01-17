@extends('layout.index')
@section('content')

<head>
    <title>Startpagina</title>
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
</head>
<div>
    <a href="{{ route('wedding.create') }}"><button type="button">Test</button></a>
    <form method="POST">
        @csrf
        <button id="start-button">Begin met het plannen van uw bruiloft</button>
    </form>
    <hr style="margin-top: 3%;" />
    <div class="page">
        <div class="circles">
            <div class="circle">1. Gastenlijst</div>
            <div class="circle">2. Locatie</div>
            <div class="circle">3. Seating</div>
            <div class="circle">4. Draaiboek</div>
            <div class="circle">5. Cadeautips</div>
            <div class="circle">6. Trouwplanner</div>
        </div>
        <div class="table-container">
            <table id="weddings">
                <thead>
                    <tr>
                        <th id="table-left-border">Kies trouwerij</th>
                        <th>Weddingcode</th>
                        <th>Datum</th>
                        <th>Link Pagina</th>
                        <th id="table-right-border"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input class="checkbox" type="radio" name="option" onchange="updateLink(event)" /></td>
                        <td>AAA</td>
                        <td>30-05-2023</td>
                        <td><a class="link-button" href="/bruiloft/AAA/gastenlijst"><button class="table-buttons">Naar Pagina</button></a></td>
                        <td>
                            <form method="POST">
                                <input name="id" style="display: none" value="" />
                                <button>Verwijder</button>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td><input class="checkbox" type="radio" name="option" onchange="updateLink(event)" /></td>
                        <td>e1j11JF6</td>
                        <td>30-05-2023</td>
                        <td><a class="link-button" href="/bruiloft/e1j11JF6/gastenlijst"><button class="table-buttons">Naar Pagina</button></a></td>
                        <td>
                            <form method="POST">
                                <input name="id" style="display: none" value="" />
                                <button>Verwijder</button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="step-line">
            <a class="step-link" href="bruiloft/weddingcode/gastenlijst">
                <div class="step-circle">1</div>
            </a>
            <div class="step-connector"></div>
            <a class="step-link" href="bruiloft/weddingcode/locatie">
                <div class="step-circle">2</div>
            </a>
            <div class="step-connector"></div>
            <a class="step-link" href="bruiloft/weddingcode/seating">
                <div class="step-circle">3</div>
            </a>
            <div class="step-connector"></div>
            <a class="step-link" href="bruiloft/weddingcode/draaiboek">
                <div class="step-circle">4</div>
            </a>
            <div class="step-connector"></div>
            <a class="step-link" href="bruiloft/weddingcode/cadeautips">
                <div class="step-circle">5</div>
            </a>
            <div class="step-connector"></div>
            <a class="step-link" href="bruiloft/weddingcode/trouwplanner">
                <div class="step-circle">6</div>
            </a>
        </div>
    </div>
</div>
<script>
    document.getElementById("pagina").innerHTML = "Startpagina"

    //update the link to the clicked radio button
    let prevRadioButton = null;

    function updateLink(event) {
        const radioButton = event.target;
        if (radioButton.type === 'radio') {
            if (prevRadioButton) {
                const prevWeddingCode = prevRadioButton.parentNode.nextElementSibling.textContent.trim();
                const prevStepLinks = document.querySelectorAll(`.step-link[href*="${prevWeddingCode}"]`);
                prevStepLinks.forEach(link => {
                    link.href = link.href.replace(prevWeddingCode, 'weddingcode');
                });
            }

            const weddingCode = radioButton.parentNode.nextElementSibling.textContent.trim();
            const stepLinks = document.querySelectorAll(`.step-link[href*="weddingcode"]`);
            stepLinks.forEach(link => {
                link.href = link.href.replace('weddingcode', weddingCode);
            });

            prevRadioButton = radioButton;
        }
    }


    // Get all the circle elements
    const circles = document.querySelectorAll('.step-circle');
    const connectors = document.querySelectorAll('.step-connector');

    // Add event listeners to each circle element
    circles.forEach((circle, index) => {
        circle.addEventListener('mouseenter', () => {
            // Add the blue-line class to the current circle and all the previous circles
            circles.forEach((c, i) => {
                if (i <= index) {
                    c.classList.add('blue-line');
                } else {
                    c.classList.remove('blue-line');
                }
            });
            // Add the blue-line class to the connectors before the current circle
            connectors.forEach((connector, i) => {
                if (i < index) {
                    connector.classList.add('blue-line');
                } else {
                    connector.classList.remove('blue-line');
                }
            });
        });

        circle.addEventListener('mouseleave', () => {
            // Remove the blue-line class from all the circles
            circles.forEach(c => {
                c.classList.remove('blue-line');
            });

            connectors.forEach(connector => {
                connector.classList.remove('blue-line');
            });
        });
    });
</script>
@endsection