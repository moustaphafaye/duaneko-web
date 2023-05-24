@extends('layouts.admin')

@section('content')


    <div class="pc-container">
        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Acceuil</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                                <li class="breadcrumb-item">Acceuil</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-md-12">
                <div class="container bootstrap snipets">
   <h1 class="text-center text-white  bg-danger rounded-3">Mes chiffres</h1>
   <div><h3 class="text-center text-dark  border border-dark rounded-3 mt-3">Signalisations</h3></div>
   <div class="row flow-offset-1">
     <div class="col-xs-6 col-md-4 Larger shadow p-3 mb-3 bg-dark border border-success rounded-3">
       <div class="product tumbnail thumbnail-3 border bg-success  border border-warning rounded-3" style=" height:200px;" ><a href="#"><img src="" alt=""></a>
         <div class="caption text-center">
           <h3 class=""><a class="text-dark" href="{{ route('report') }}">Le nombre Total de signalisation</a></h3>
           <h4 class="price">{{ $totalreport }} Dépots</h4>
           <span class="price sale"></span>
         </div>
       </div>
     </div>
     <div class="col-xs-6 col-md-4 Larger shadow p-3 mb-3 bg-dark border border-success rounded-3" >
       <div class="product tumbnail thumbnail-3 border bg-success  border border-white rounded-3" style=" height:200px;" ><a href="#"><img src="" alt=""></a>
         <div class="caption text-center">
           <h3 class=""><a class="text-dark" href="#">Le nombre de signalisation néttoyé</a></h3>
           <h4 class="price">{{$report_done}} Dépots</h4>
           <span class="price sale"></span>
         </div>
       </div>
     </div>
     <div class="col-xs-6 col-md-4  shadow-lg p-3 mb-3 bg-dark border border-danger rounded-3">
       <div class="product tumbnail thumbnail-3 border bg-success  border border-danger rounded-3" style=" height:200px;" ><a href="#"><img src="" alt=""></a>
         <div class="caption text-center">
           <h3 class=""><a class="text-dark" href="#">Le nombre de signalisation en entente </a></h3>
           <h4 class="price">{{$report_in_progress}} Dépots</h4>
           <span class="price sale"></span>
         </div>
       </div>
     </div>
     <div class="col-xs-6 col-md-4 ">
        <h3 class="text-center   border border-dark rounded-3 bg-danger mt-3"> <a class="text-dark" href="{{ route('listCompanies') }}"> Entreprises </a>  </h3>
       <div class=" product tumbnail text-center thumbnail-3 border bg-success border border-danger rounded-3" style=" height:180px;" ><a href="#"><img src="" alt=""></a>
        <h5>Le nombre d'entreprise inscrit sur Duanéko est :</h5>
        <h4>{{$totalcompanies}} Companies</h4>
       </div>
     </div>
     <div class="col-xs-6 col-md-4">
        <h3 class="text-center  bg-danger border border-dark rounded-3 mt-3"><a class="text-dark" href="">Les Agents admin</a></h3>
       <div class="product tumbnail text-center thumbnail-3 border bg-success mb-3 border border-danger rounded-3" style=" height:180px;" ><a href="#"><img src="" alt=""></a>
        <h5>Le nombre d'Agent admin inscrit sur Duanéko est :</h5>
        <h4>{{$agent_admin}} Agents admin</h4>
       </div>
     </div>
     <div class="col-xs-6 col-md-4">
        <h3 class="text-center text-dark bg-danger border border-dark rounded-3 mt-3"> <a class="text-dark" href="">Les Agents</a></h3>
       <div class="product tumbnail text-center thumbnail-3 border bg-success mb-3 border border-danger rounded-3" style=" height:180px;" ><a href="#"><img src="" alt=""></a>
        <h5>Le nombre d'Agent inscrit sur Duanéko est :</h5>
        <h4>{{$agent}} Agents</h4>
       </div>
     </div>
     
     
    
   </div>
 </div>
                </div>
            </div>
        </div>
    </div>
@endsection

