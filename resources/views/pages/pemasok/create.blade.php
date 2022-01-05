@extends('layouts.apps.admin.admin-global')

@section('breadcrumb')
<h6 class="h2 text-white d-inline-block mb-0">Tables</h6>
<nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Pemasok</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row mb-6">
    <div class="col-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <h1> Tambah Pemasok </h1>
            </div>
            <div class="card-body">
                <form action="{{ route('pemasok.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama-pemasok" class="form-control-label">Nama Pemasok</label>
                        <input class="form-control @error('name') is-invalid @enderror" name="name"
                            placeholder="Nama Pemasok" type="text" id="nama-pemasok" value="{{ old('name') }}" required>
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="alamat" class="form-control-label">Alamat</label>
                        <input class="form-control @error('address') is-invalid @enderror" name="address"
                            placeholder="Alamat" type="text" id="alamat" value="{{ old('address') }}"
                            required>
                        @error('address')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="telepon" class="form-control-label">Telepon</label>
                        <input class="form-control @error('telephone') is-invalid @enderror" name="telephone"
                            placeholder="Telepon" type="tel" id="telepon" value="{{ old('telephone') }}" required>
                        @error('telephone')
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