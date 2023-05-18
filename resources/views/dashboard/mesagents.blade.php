@extends('layouts.admin')

@section('content')

<div class="pc-container">
    <div class="pcoded-content">
        <div class="page-header d-block">
            <div class="row align-items-center">
                <div class="col-md-10">
                   <div class="page-header-title">
                        <h5 class="m-b-10">Liste des agents</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('agents') }}">Agents</a></li>
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
                                        <th scope="col"><a href="#">Prenom</a></th>
                                        <th scope="col"><a href="#">Nom</a></th>
                                        <th scope="col"><a href="#">Adresse_Email</a></th>
                                        <th scope="col"><a href="#">Telephone</a></th>
                                        <th scope="col"><a href="#">Details</a></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($myagents as $agent)
                                        <tr>
                                            <th scope="row">{{ $agent->id }}</th>
                                            <td>{{ $agent->first_name }}</td>
                                            <td>{{ $agent->last_name }}</td>
                                            <td>{{ $agent->email }}</td>
                                            <td>{{ $agent->phone }}</td>
                                            <td>
                                                <a class="btn btn-success" href="{{ route('showAgents', $agent) }}">Modifier</a>
                                                <a href="#"><button class="btn btn-danger" onclick="if(confirm('Voulez-vous vraiment supprimer agent ?'));{document.getElementById('{{ $agent->id }}').submit()}">Supprimer</button></a>
                                                <form id="{{ $agent->id }}" action="{{ route('deleteAgents', $agent) }}" method="post">
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


