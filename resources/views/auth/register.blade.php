@extends('layouts.app')

@section('content')
    <div class="signup-form">
        <div class="auth-wrapper">
            <div class="auth-content">
                <div class="card">
                    <div class="row align-items-center text-center">
                        <div class="col-md-12">
                            <div class="card-body">
                                <img src="{{ asset('dashboard/src/assets/images/logo-dark.svg') }}" alt=""
                                    class="img-fluid mb-4">
                                <h4 class="mb-3 f-w-400">S'inscrire</h4>
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" class="form-control" placeholder="Prenom" name="first_name"
                                            autocomplete="name" autofocus>
                                        @if ($errors->has('first_name'))
                                            <span class="">
                                                <strong>{{ $errors->first('first_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" class="form-control" placeholder="Nom" name="last_name"
                                            autocomplete="name">
                                        @if ($errors->has('last_name'))
                                            <span class="">
                                                <strong>{{ $errors->first('last_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i data-feather="mail"></i></span>
                                        <input type="email" class="form-control" placeholder="Adresse e-mail"
                                            name="email">
                                        @if ($errors->has('email'))
                                            <span class="">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i data-feather="phone"></i></span>
                                        <input type="tel" class="form-control" placeholder="Numero Telephone"
                                            name="phone">
                                        @if ($errors->has('phone'))
                                            <span class="">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="input-group mb-4">
                                        <span class="input-group-text"><i data-feather="lock"></i></span>
                                        <input type="password" class="form-control" placeholder="Mot de passe"
                                            name="password">
                                        @if ($errors->has('password'))
                                            <span class="">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="input-group mb-4">
                                        <span class="input-group-text"><i data-feather="lock"></i></span>
                                        <input type="password" class="form-control"
                                            placeholder="Confirmation de Mot de passe" name="password_confirmation">
                                        @if ($errors->has('password'))
                                            <span class="">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="input-group mb-4">
                                        <span class="input-group-text"><i data-feather="users"></i></span>
                                        <label for="role" class="form-control">
                                            <select name="role" id="role" class="form-control">
                                                <option value="admin">Admin</option>
                                                <option value="agent" selected>Agent</option>
                                            </select>
                                        </label>
                                    </div>
                                    <div class="input-group mb-4">
                                        <span class="input-group-text"><i data-feather="home"></i></span>
                                        <label for="company" class="form-control">
                                            <select class="form-control" name="company_id" id="company_id">
                                                @foreach ($companies as $company)
                                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                                @endforeach
                                            </select>
                                        </label>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block mb-4">
                                        {{ "S'inscrire" }}
                                    </button>
                                    <p class="mb-2">Vous avez déjà un compte? <a href="{{ route('login') }}"
                                            class="f-w-400">Se connecter</a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div>
@endsection
