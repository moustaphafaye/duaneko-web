@extends('layouts.admin')

<style>
    #map {
        height: 600px;
    }

    .custom-div-icon i.awesome {
      margin: 12px auto;
      font-size: 22px;
    }
    /* #map {
  height: 100%;
} */

/* 
 * Optional: Makes the sample page fill the window. 
 */
/* html,
body {
  height: 100%;
  margin: 0;
  padding: 0;
} */
    
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
        let map = window.L.map('map').setView([latitude, longitude], 13);

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
        // AIzaSyCyqqkwSaDIL5FFTu1syWMyw6UP0U1YW1w
        window.L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 15,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
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
            var latlng = e.geocode.center;
            L.marker(longitude).addTo(map);
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

    if (navigator.geolocation) { navigator.geolocation.getCurrentPosition(success, error); }

//////////////////////////////////Délimiter///////////////////////////////////////////



        // // Créer une carte Leaflet
        // var map = L.map('map');
        // let map = window.L.map('map').setView([latitude, longitude], 13);
        // // Ajouter une couche de tuiles (par exemple, OpenStreetMap)
        // L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        // attribution: '© OpenStreetMap contributors'
        // }).addTo(map);

        // // Ajouter le contrôle de géocodage
        // var geocoder = L.Control.geocoder().addTo(map);

        // // Liste de marqueurs (exemple)
        // var markers = [
        // { lat: 51.505, lng: -0.09, nom: 'Marqueur 1' },
        // { lat: 51.51, lng: -0.1, nom: 'Marqueur 2' },
        // { lat: 51.505, lng: -0.11, nom: 'Marqueur 3' }
        // ];

        // // Fonction pour afficher les marqueurs dans la zone de recherche
        // function afficherMarqueursDansZone(zone) {
        // // Supprimer tous les marqueurs existants de la carte
        // map.eachLayer(function(layer) {
        //     if (layer instanceof L.Marker) {
        //     map.removeLayer(layer);
        //     }
        // });

        // // Boucler sur les marqueurs
        // markers.forEach(function(marker) {
        //     var latlng = L.latLng(marker.lat, marker.lng);

        //     // Vérifier si le marqueur est dans la zone de recherche
        //     if (zone.contains(latlng)) {
        //     // Créer un marqueur et l'ajouter à la carte
        //     L.marker(latlng).addTo(map).bindPopup(marker.nom);
        //     }
        // });
        // }

        // // Écouter l'événement 'markgeocode' du contrôle de géocodage
        // geocoder.on('markgeocode', function(e) {
        // var boundingBox = e.geocode.bbox;

        // // Vérifier si une zone de recherche est disponible
        // if (boundingBox) {
        //     var southWest = L.latLng(boundingBox.getSouth(), boundingBox.getWest());
        //     var northEast = L.latLng(boundingBox.getNorth(), boundingBox.getEast());
        //     var zone = L.latLngBounds(southWest, northEast);

        //     // Appeler la fonction pour afficher les marqueurs dans la zone de recherche
        //     afficherMarqueursDansZone(zone);
        // }
        // });



</script>


