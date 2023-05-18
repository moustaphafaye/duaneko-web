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
                    <div id="map" ></div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    // var myMap;
    // var lyrOSM;

    // $(document).ready(function(){
    //     myMap = L.map('map_div', {center:[38.91454,-77.02171], zoom:12, zoomControl:false});

    //     lyrOSM = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png');
    //     myMap.addLayer(lyrOSM)
    // });

    function success(position) {
    
        let map = window.L.map('map').setView([14.7098454, -17.4721324], 14);

      
        window.L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 15,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
        // window.L.marker(
        //         [14.7098454, -17.4721324],
        //         { icon: icon }) 
        //         .bindPopup(
        //         `<div class='card' style='width: 18rem;'>
        //             <img src='' class='card-img-top' alt='' loading='lazy'>
        //             <div class="card-body">
        //                 <h5 class='card-title'><span class="badge bg-danger"></span></h5>
        //                 <p class='card-text'></p>
        //                 <a class="btn btn-success" href="{{ url('dashboard/reports/') }}">Voir</a>
        //             </div>
        //         </div>`
        //     ).addTo(map);
        // L.Control.geocoder().addTo(map);
        var geocoder = L.Control.geocoder({
         defaultMarkGeocode: false
        })
        .on('markgeocode', function(e) {
            var bbox = e.geocode.bbox;
            var poly = L.polygon([
            bbox.getSouthEast(),
            bbox.getNorthEast(),
            bbox.getNorthWest(),
            bbox.getSouthWest()
            ]).addTo(map);
            map.fitBounds(poly.getBounds());
        })
        .addTo(map);
    }

    function error() {
        let map = document.getElementById("map");
        let p = document.createElement("p");
        let textDescription = document.createTextNode("Impossible de récupérer votre position.");
        p.appendChild(textDescription);
        map.appendChild(p);
    }

    if (navigator.geolocation) { 
        navigator.geolocation.getCurrentPosition(success, error); 
    }

    // let map = window.L.map('map').setView([38.91454, -77.02171], 13);

    // icon = L.divIcon({
    //         className: 'custom-div-icon',
    //         html: "<div style='background-color:#4838cc;' class='marker-pin'></div><i class='fa fa-dumpster awesome'>",
    //         iconSize: [50, 50],
    //         iconAnchor: [15, 42]
    //     });
    //     window.L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    //         maxZoom: 15,
    //         attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    //     }).addTo(map);
</script>
