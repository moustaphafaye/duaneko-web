@extends('layouts.admin')

<style>
 #map {
    height: 700px;
    width: 100%;
 }
 .custom-div-icon i.awesome {
      margin: 12px auto;
      font-size: 22px;
    }
    #floating-panel {
      position: absolute;
      top: 10px;
      margin-top: 200px;
      left: 25%;
      z-index: 5;
      background-color: #fff;
      padding: 5px;
      border: 1px solid #999;
      text-align: center;
      font-family: "Roboto", "sans-serif";
      line-height: 30px;
      padding-left: 10px;
    }
 
    #floating-panel {
      position: absolute;
      top: 5px;
      left: 50%;
      margin-left: -180px;
      width: 350px;
      z-index: 5;
      background-color: #fff;
      padding: 5px;
      border: 1px solid #999;
    }
 
    #latlng {
      width: 225px;
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
            <br /><br /><br /><br />
            <div id="floating-panel">
                <div id="formtted-address"></div>
                <!-- <input id="latlng" type="text" value="14.767749,-17.448815" />
                <input id="submit" type="button" value="Reverse Geocode" /> -->
            </div>
            <div id="result"></div>
            <div class="row">
                <div class="col-xl-12 col-md-12" onload="success()">
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
<!-- <script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script> -->
<script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>

<script>
                    // This example requires the Places library. Include the libraries=places
                // parameter when you first load the API. For example:
                // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
               

                function initMap() {
                    // let latitude = position.coords.latitude;
                    //  let longitude = position.coords.longitude;
                    var options = {
                        center: { lat : 14.747990, lng:-17.425185}, 
                        zoom : 13, 
                    }
                    const reports = <?php echo json_encode($reports); ?>;
                    map = new google.maps.Map(document.getElementById("map"),options);

                    for (let index = 0; index < reports.length; index++) {
                        let report = reports[index];
                    const marker = new google.maps.Marker({
                        position:{lat : report.latitude , lng:report.longitude},
                        map:map,
                        icon:"https://img.icons8.com/nolan/2x/marker.png",
                        });
                        const detailWindow = new google.maps.InfoWindow({
                            content: `<div class='card' style='width: 18rem;'>
                    <img src='${report.image}' class='card-img-top' alt='${report.description}' loading='lazy'>
                    <div class="card-body">
                        <h5 class='card-title'><span class="badge bg-danger">${report.type}</span></h5>
                        <p class='card-text'>${report.description}</p>
                        <a class="btn btn-success" href="{{ url('dashboard/reports/${report.id}') }}">Voir</a>
                    </div>
                    </div>`
                        });
                        marker.addListener("click",()=>{
                            detailWindow.open(map,marker);
                        })
                    }
                    // var geocoder = new google.maps.Geocoder();
                    // const infoWindow = new google.maps.InfoWindow();
                    // geocodeLatLng(geocoder,map,infoWindow) 
                    // document.getElementById('submit').addEventListener('click'),()=>{
                    //     geocodeLatLng(geocoder,map,infoWindow)
                    // }                       
                  
                }

                geocode();

                function geocode(){
                    var location = '14.723712,-17.494233';
                    axios.get('https://maps.googleapis.com/maps/api/geocode/json',{
                        
                        params:{
                        address:location,
                        key:'AIzaSyB5zwT53mXvHqmw_CXQJiMU4iWtG2BND_o'
                    }
                    }).then(function(response){

                    var lelieu = response.data.results[0].formatted_address;
                    var format = `
                        <ul class="list-group">
                        <li class="list-group-item">${lelieu}</li>
                        </ul>
                    `;
                        console.log(response.data.results[0].address_components);
                    var addCom = response.data.results[0].address_components;
                    var addcompOut = `<ul class="list-group">`;
                    for(var i =0;i <addCom.length;i++){
                        addcompOut += `<li class="list-group-item"> ${ addCom [i].type} </li> `;
                    }
                    document.getElementById('formtted-address').innerHTML = format 

                    }).catch(function(error){
                        console.log(error)
                    })
                    
                }






                
                // function geocodeLatLng(geocoder,map,infoWindow){
                //     const input =document.getElementById('latlng').value
                    
                //     const latlongStr = input.split(",",2)

                //     /////////latitude et longitude////////////
                //     const latlng = {
                //         lat:parseFloat(latlongStr[0]),
                //         lng:parseFloat(latlongStr[1]),
                //     }
                //     geocoder.geocode({location:latlng}).then((response)=>{
                //         console.log(response)

                //         if(response.results[0]){
                //             map.setZoom(13)
                //             const marker = new google.maps.Marker({
                //                 position:latlng,
                //                 map:map
                //             })
                //             infoWindow.setcontent(response.results[0].formatted_address)
                //             document.getElementById('result').innerHTML = `<h1 style ="text-align:center;">${response.results[0].formatted_address}</h1>`
                //         }
                //     })
                // }
                   
                

</script>



