@extends('layouts.app')

@section('content')

<div class="login-form">
    <div class="auth-wrapper">
        <div class="auth-content">
            <div class="card">
                <div class="row align-items-center text-center">
                    <div class="col-md-12">
                        <div class="card-body">
                            <img src="{{ asset('admin/assets/images/logo-dark.svg') }}" alt="" class="img-fluid mb-4">
                            <h4 class="mb-3 f-w-400">S'identifier</h4>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i data-feather="mail"></i></span>
                                    <input type="email" class="form-control" placeholder="Adresse e-mail" name="email">
                                </div>
                                <div class="input-group mb-4">
                                    <span class="input-group-text"><i data-feather="lock"></i></span>
                                    <input type="password" class="form-control" placeholder="Mot de passe" name="password">
                                </div>
                                <div class="form-group text-left mt-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                        <label class="form-check-label" for="flexCheckChecked">
                                            Enregistrer les informations d'identification
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-block btn-primary mb-4">
                                    {{ ("S'identifier") }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection




