@extends('layouts.apps.kasir.kasir-global')

@section('breadcrumb')
<h6 class="h2 text-white d-inline-block mb-0">Kasir</h6>
<nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Penjualan</a></li>
        <li class="breadcrumb-item active" aria-current="page">Kasir</li>
    </ol>
</nav>
@endsection

@section('penjualan')
{{ 'active' }}
@endsection

@section('card-stats')
<div class="row mb-3">
    <div class="col-xl-6 col-md-12">
        <div class="card">
            <!-- Card body -->
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <label for="no-nota">Nota</label>
                    </div>
                    <div class="col">
                        <input type="text" id="no-nota" value="{{ $nota }}" class="form-control form-control-muted"
                            disabled>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-3">
                        <label for="tanggal">Tanggal</label>
                    </div>
                    <div class="col">
                        <input type="text" id="tanggal" value="{{ $tanggal }}" class="form-control form-control-muted"
                            disabled>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-3">
                        <label for="nama">Nama Kasir</label>
                    </div>
                    <div class="col">
                        <input type="text" id="nama" value="{{ Auth::user()->name }}"
                            class="form-control form-control-muted" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-md-12">
        <div class="card">
            <!-- Card body -->
            <div class="card-body">
                <div class="row mt-2 mb-2">
                    <div class="col">
                        <h3 class="card-title text-uppercase text-muted">Total Bayar</h3>
                        <span class="h2 font-weight-bold mt-2">
                            <h1 class="display-1"> Rp {{ empty($total) ? '0' : number_format($total, 2, ',', '.') }}
                            </h1>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header border-0">
                <form action="{{ route('add-barang.penjualan') }}" method="POST">
                    @csrf
                    <div class="row align-items-center">
                        <div class="form-group col-4">
                            <select class="form-control @error('name') is-invalid @enderror" name="id" id="namaBarang"
                                required>
                                @foreach ($barangs as $barang)
                                <option value="{{ $barang->id }}">{{ $barang->name }}</option>
                                @endforeach
                            </select>
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col-2">
                            <input type="number" name="quantity" placeholder="Jumlah" class="form-control" required>
                        </div>
                        <div class="form-group col">
                            <button type="submit" class="btn btn-primary"> Tambah </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="table-responsive">
                <!-- Projects table -->
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Kode Barang</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Harga Satuan</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Subtotal</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($items->count())

                        @foreach ($items as $item)
                        <tr>
                            <td> {{ $item->id }} </td>
                            <td> {{ $item->name }} </td>
                            <td> {{ $item->price }} </td>
                            <td>
                                <form action="{{ route('penjualan.update', $item->id) }}" method="POST">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" value="{{ $item->price }}" name="price">
                                    <input type="number" value="{{ $item->quantity }}" name="qty">
                                    <button type="submit" class="btn btn-sm btn-warning"><i
                                            class="ni ni-settings-gear-65 text-netral"></i></button>
                                </form>
                            </td>
                            <td> {{ $subtotal }} </td>
                            <td>
                                <form class="d-inline" onsubmit="return confirm('Data will be Deleted, Are you sure?')"
                                    action="{{ route('penjualan.destroy', $item->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" class="btn btn-sm btn-danger waves-effect waves-light"
                                        value="Delete">
                                </form>
                            </td>
                        </tr>
                        @endforeach

                        @else
                        <tr>
                            <td colspan="5">
                                <p class="text-center fs-4">Data Kosong</p>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="row">
                <div class="col-3 m-2">
                    <div class="form-group">
                        <label for="dibayar">Dibayar</label>
                        <input type="number" class="form-control" onkeyup="sum()" placeholder="Di Bayar" id="dibayar">
                    </div>
                </div>
                <div class="col-3 m-2">
                    <div class="form-group">
                        <label for="kembali">Kembali</label>
                        <input type="text" class="form-control" placeholder="Kembali" id="kembali">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col ml-2 mb-2">
                    <a href="{{ route('simpan.penjualan', $nota) }}" class="btn btn-primary w-25"> Simpan </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-js')
<script>
    $(document).ready(function() {
            $('#namaBarang').select2();
        });
</script>

<script>
    function sum() {

            var dibayar = document.getElementById('dibayar').value

            var result = parseInt(dibayar) - {{ $total }};
            if (!isNaN(result)) {
            document.getElementById('kembali').value = formatRupiah(result, "Rp. ")
            }
        }

        function formatRupiah(angka, prefix) {
            var number_string = angka.toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi)

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.')
            }
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '')
        }
</script>
@endsection