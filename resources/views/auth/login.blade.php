@extends('layouts.apps.auth')

@section('title')
<title>Log In</title>
@endsection

@section('form')
    <div class="text-center text-muted mb-4">
        <small>Or sign in with credentials</small>
    </div>

    <form method="POST" action="{{ route('login') }}" role="form">
        @csrf

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <span class="alert-text">
                <x-auth-validation-errors :errors="$errors" />
            </span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <div class="form-group mb-3">
            <div class="input-group input-group-merge input-group-alternative">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                </div>

                <!-- Email Address -->
                <x-input id="email" class="form-control" placeholder="Email" type="email" name="email" :value="old('email')" required autofocus />
            </div>
        </div>
        <div class="form-group">
            <div class="input-group input-group-merge input-group-alternative">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                </div>

                <!-- Password -->
                <x-input id="password" class="form-control" placeholder="Password" type="password" name="password" required autocomplete="current-password" />
            </div>
        </div>
        <div class="custom-control custom-control-alternative custom-checkbox">
            <input class="custom-control-input" id=" customCheckLogin" type="checkbox" name="remember">
            <label class="custom-control-label" for=" customCheckLogin">
                <span class="text-muted">{{ __('Remember me') }}</span>
            </label>
        </div>
        <div class="text-center">
            <x-button class="btn btn-primary my-4">
                {{ __('Log in') }}
            </x-button>
        </div>
    </form>
@endsection

@section('form-footer')
    <div class="row mt-3">
        <div class="col-6">
            @if (Route::has('password.request'))
            <a class="text-light" href="{{ route('password.request') }}">
                <small>{{ __('Forgot your password?') }}</small>
            </a>
            @endif
        </div>
        <div class="col-6 text-right">
            <a href="{{ route('register') }}" class="text-light"><small>Create new account</small></a>
        </div>
    </div>
@endsection