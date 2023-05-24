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
        // console.log(map);
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
////////////////////////////////////--ici--////////////////////////////////
function pointInPolygon(zone, region) {
  const vertices = region.vertices;
  const latitude = zone.latitude;
  const longitude = zone.longitude;
  let intersections = 0;
  const verticesCount = vertices.length;

  for (let i = 0, j = verticesCount - 1; i < verticesCount; j = i++) {
    const xi = vertices[i].latitude;
    const yi = vertices[i].longitude; 
    const xj = vertices[j].latitude;
    const yj = vertices[j].longitude;

    const intersect =
      (yi > longitude) !== (yj > longitude) &&
      (latitude <
        ((xj - xi) * (longitude - yi)) / (yj - yi) + xi);

        // alert(intersect);
    if (intersect) {
      intersections++;
    }
  }
 
  return intersections % 2 !== 0;
}

// Coordonnées de la zone
const zone = {
    latitude: 14.721571, 
    longitude: -17.5029931,
};

// Définition du polygone de la région (ex : New York)
const region = {
    vertices: [
        { latitude: 14.7333799, longitude: -17.4755624 },   
        { latitude: 14.7097626, longitude: -17.4755624 },
        { latitude: 14.7097626, longitude: -17.5098244 },
        { latitude: 14.7333799, longitude: -17.5098244 },
    ],
};


// Création de la carte
// let map = window.L.map('map').setView([14.721571, -17.5029931], 13);
const map = L.map("map").setView([14.721571, -17.5029931], 12);


// Ajout des tuiles de la carte
L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",{
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'    ,
    }
    ).addTo(map);

      // Vérification si la zone est à l'intérieur de la région
      const isInsideRegion = pointInPolygon(zone, region);

      // Si la zone est dans la région, affiche le marqueur
      if (isInsideRegion) {
       L.marker([zone.latitude, zone.longitude]).addTo(map);
      } 
    




</script>


