@extends('layouts.apps.admin.admin-global')

@section('breadcrumb')
<h6 class="h2 text-white d-inline-block mb-0">Tables</h6>
<nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Kasir</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row mb-6">
    <div class="col-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <h1> Edit Kasir </h1>
            </div>
            <div class="card-body">
                <form action="{{ route('kasir.update', $kasir->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="nama" class="form-control-label">Nama</label>
                        <input class="form-control @error('name') is-invalid @enderror" name="name"
                            placeholder="Nama" type="text" id="nama" value="{{ $kasir->name }}" required>
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-control-label">Email</label>
                        <input class="form-control @error('email') is-invalid @enderror" name="email"
                            placeholder="Email" type="email" id="email" value="{{ $kasir->email }}" required>
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-control-label">Password</label>
                        <input class="form-control @error('password') is-invalid @enderror" name="password"
                            placeholder="Password" type="password" id="password" required>
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation" class="form-control-label">Confirm Password</label>
                        <input class="form-control @error('password') is-invalid @enderror" name="password_confirmation"
                            placeholder="Confirm Password" type="password" id="password_confirmation" required>
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary float-right"> Simpan </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection