@extends('layouts.apps.auth')

@section('title')
    <title>Sign Up</title>
@endsection

@section('form')
    <div class="text-center text-muted mb-4">
        <small>Or sign up with credentials</small>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

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

        <div class="form-group">
            <div class="input-group input-group-merge input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                </div>
                <x-input id="name" class="form-control" placeholder="Name" type="text" name="name" :value="old('name')" required autofocus />
            </div>
        </div>
        <div class="form-group">
            <div class="input-group input-group-merge input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                </div>
                <x-input id="email" class="form-control" placeholder="Email" type="email" name="email" :value="old('email')" required />
            </div>
        </div>
        <div class="form-group">
            <div class="input-group input-group-merge input-group-alternative">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                </div>
                <x-input id="password" class="form-control" placeholder="Password" type="password" name="password" required autocomplete="new-password" />
            </div>
        </div>
        <div class="form-group">
            <div class="input-group input-group-merge input-group-alternative">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                </div>
                <x-input id="password_confirmation" class="form-control" placeholder="Confirm Password" type="password" name="password_confirmation" required />
            </div>
        </div>
        <div class="text-center">
            <x-button class="btn btn-primary mt-4">
                {{ __('Create Account') }}
            </x-button>
        </div>
    </form>
@endsection

@section('form-footer')
    <div class="row mt-3">
        <div class="col-6">
            <a class="text-light" href="{{ route('login') }}">
                <small> {{ __('Already registered? Login') }} </small>
            </a>
        </div>
    </div>
@endsection