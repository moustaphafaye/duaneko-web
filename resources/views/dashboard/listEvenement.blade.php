@extends('layouts.admin')

@section('content')
<div class="pc-container">
    <div class="pcoded-content">
        <div class="page-header d-block">
            <div class="row align-items-center">
                <div class="col-md-10">
                   <div class="page-header-title">
                        <h5 class="m-b-10">Liste des évènements</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('eventform') }}">Évènement</a></li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Basic Table</h5>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col"><a href="#">Id</a></th>
                                        <th scope="col"><a href="#">Nom</a></th>
                                        <th scope="col"><a href="#">Description</a></th>
                                        <th scope="col"><a href="#">Date</a></th>
                                        <th scope="col"><a href="#">Heure</a></th>
                                        <th scope="col"><a href="#">Compagnie</a></th>
                                        <th scope="col"><a href="#">Agent</a></th>
                                        <th scope="col"><a href="#">Actions</a></th>

                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($mesEvents as $event)
                                    <tr>
                                        <th scope="row">{{ $event->id }}</th>
                                        <td>{{ $event->nom }}</td>
                                        <td>{{ $event->description }}</td>
                                        <td>{{ $event->date_evenement }}</td>
                                        <td>{{ $event->heure_evenement }}</td>
                                        @foreach ($agents as $agent)
                                        
                                        @if($agent->id==$event->agent_id)
                                        @foreach ($companies as $company)
                                        @if($company->id==$agent->company_id)
                                        <td>{{$company->name}}</td>
                                        <td>{{$agent-> first_name}} {{$agent-> last_name}}</td>
                                        @endif
                                        @endforeach
                                        @endif

                                        @endforeach
                                        <td>
                                            <a class="btn btn-success" href="{{ route('show_evenement', $event) }}">Modifier</a>
                                            <a href="#"><button class="btn btn-danger" onclick="if(confirm('Voulez-vous vraiment supprimer cet évènement ?'));{document.getElementById('{{ $event->id }}').submit()}">Supprimer</button></a>
                                            <form id="{{ $event->id }}" action="{{ route('delete_evenement', $event) }}" method="post">
                                                @csrf
                                                <input type="hidden" name="_method" value="delete">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                @if(session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


