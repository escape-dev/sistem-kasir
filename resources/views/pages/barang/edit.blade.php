@extends('layouts.apps.admin.admin-global')

@section('breadcrumb')
<h6 class="h2 text-white d-inline-block mb-0">Tables</h6>
<nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Barang</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row mb-6">
    <div class="col-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <h1> Edit Barang </h1>
            </div>
            <div class="card-body">
                <form action="{{ route('barang.update', $barang->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="nama-barang" class="form-control-label">Nama Barang</label>
                        <input class="form-control @error('name') is-invalid @enderror" name="name"
                            placeholder="Nama Barang" type="text" id="nama-barang" value="{{ $barang->name }}" required>
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="harga-barang" class="form-control-label">Harga Barang</label>
                        <input class="form-control @error('price') is-invalid @enderror" name="price"
                            placeholder="Harga Barang" type="number" id="harga-barang" value="{{ $barang->price }}"
                            required>
                        @error('price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="stok-barang" class="form-control-label">Stok Barang</label>
                        <input class="form-control @error('stok') is-invalid @enderror" name="stok"
                            placeholder="Stok Barang" type="number" id="stok-barang" value="{{ $barang->stok }}" required>
                        @error('stok')
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