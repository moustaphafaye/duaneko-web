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
              <h5 class="m-b-10">Evenements</h5>
            </div>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
              <li class="breadcrumb-item"><a href="{{ route('liste_evenement') }}">Liste des évènements</a></li>
              <!-- <li class="breadcrumb-item">Agents</li> -->
            </ul>
          </div>
        </div>
      </div>
    </div>
     <div class="col-md-12">
      <div class="card mt-5">
        <div class="card-header">
          <h5>Formulaire</h5>
        </div>
        <div class="card-body">
          <h5>Enregistrement de l'agent</h5>
          <hr>
          <div class="row">
          <div class="col-xl-12 col-md-12">
          <form method="POST" action="{{ route('creerEvenement') }}">
              @csrf  
              <div class="input-group mb-3">
                <span class="input-group-text"><i data-feather="user"></i></span>
                  <input type="text" class="form-control" placeholder="Titre de l'évènement" name="nom"
                    autocomplete="name" autofocus>
                    @if ($errors->has('nom'))
                    <span class="invalid-feedback d-block" style="text-align: center">
                    <strong>{{ $errors->first('nom') }}</strong>
                </span>
                    @endif
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text"><i data-feather=""></i></span>
                  <textarea  cols="30" rows="10" class="form-control " placeholder="Description" name="description"></textarea>
                    @if ($errors->has('description'))
                      <span class="invalid-feedback d-block" style="text-align: center">
                        <strong>{{ $errors->first('description') }}</strong>
                      </span>
                    @endif
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                <input type="date" class="form-control" placeholder="Date de l'évènenement"  name="date_evenement">
                  @if ($errors->has('date_evenement'))
                    <span class="invalid-feedback d-block" style="text-align: center">
                      <strong>{{ $errors->first('date') }}</strong>
                    </span>
                  @endif
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa fa-clock"></i></span>
                <input type="time" class="form-control" placeholder="heure de l'évènenement"  name="heure_evenement">
                  @if ($errors->has('heure_evenement'))
                    <span class="invalid-feedback d-block" style="text-align: center">
                      <strong>{{ $errors->first('heure_evenement') }}</strong>
                    </span>
                  @endif
              </div>
            <button type="submit" class="btn btn-primary btn-block mb-4">
              {{ "Enregistrer" }}
            </button>
            @if(session('success'))
              <div class="alert alert-success">{{ session('success') }}</div>
            @endif
          </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection()