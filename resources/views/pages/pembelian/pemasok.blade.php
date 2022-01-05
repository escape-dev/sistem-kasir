@extends('layouts.apps.kasir.kasir-global')

@section('breadcrumb')
<h6 class="h2 text-white d-inline-block mb-0">Pilih Pemasok</h6>
<nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Pembelian</a></li>
        <li class="breadcrumb-item active" aria-current="page">Pemasok</li>
    </ol>
</nav>
@endsection

@section('pembelian')
    {{ 'active' }}
@endsection

@section('content')
<div class="row mb-6">
    <div class="col-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <h1> Pilih Pemasok </h1>
            </div>
            <div class="card-body">
                <form action="{{ route('pemasok.send') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="namaPemasok">Nama Pemasok</label>
                        <select class="form-control @error('pemasok') is-invalid @enderror" name="pemasok" id="namaPemasok">
                            @foreach ($pemasoks as $pemasok)
                                <option value="{{ $pemasok->id }}">{{ $pemasok->name }}</option>
                            @endforeach
                        </select>
                        @error('pemasok')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary float-right"> Next </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-js')
    <script>
        $(document).ready(function() {
            $('#namaPemasok').select2();
        });
    </script>
@endsection