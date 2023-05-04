@extends('layouts.admin')

<style>
    #map {
        height: 600px;
    }

    .custom-div-icon i.awesome {
      margin: 12px auto;
      font-size: 22px;
    }
</style>

@section('content')
    <div class="pc-container">
        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Signalements</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                                <li class="breadcrumb-item"><a href="#!">Signalements</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-md-12" onload="success()">
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function success(position) {
        let latitude = position.coords.latitude;
        let longitude = position.coords.longitude;
        let map = window.L.map('map').setView([latitude, longitude], 12);

        const reports = <?php echo json_encode($reports); ?>;

        icon = L.divIcon({
            className: 'custom-div-icon',
            html: "<div style='background-color:#4838cc;' class='marker-pin'></div><i class='fa fa-dumpster awesome'>",
            iconSize: [50, 50],
            iconAnchor: [15, 42]
        });

        for (let index = 0; index < reports.length; index++) {
            let report = reports[index];
            window.L.marker(
                [report.latitude, report.longitude],
                { icon: icon })
                .bindPopup(
                `<div class='card' style='width: 18rem;'>
                    <img src='${report.image}' class='card-img-top' alt='${report.description}' loading='lazy'>
                    <div class="card-body">
                        <h5 class='card-title'><span class="badge bg-danger">${report.type}</span></h5>
                        <p class='card-text'>${report.description}</p>
                        <a class="btn btn-success" href="{{ url('dashboard/reports/${report.id}') }}">Voir</a>
                    </div>
                </div>`
            ).addTo(map);
        }

        window.L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
    }

    function error() {
        let map = document.getElementById("map");
        let p = document.createElement("p");
        let textDescription = document.createTextNode("Impossible de récupérer votre position.");
        p.appendChild(textDescription);
        map.appendChild(p);
    }

    if (navigator.geolocation) { navigator.geolocation.getCurrentPosition(success, error); }
</script>


