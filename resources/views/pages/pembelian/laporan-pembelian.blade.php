@extends('layouts.apps.admin.admin-global')

@section('breadcrumb')
    <h6 class="h2 text-white d-inline-block mb-0">Tables</h6>
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="#">Tables</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pembelian</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="card bg-default shadow">
                <div class="card-header bg-dark">
                    <h1 class="text-neutral">Laporan Pembelian</h1>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-dark table-flush">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col" class="sort" data-sort="no-nota">No Nota</th>
                            <th scope="col" class="sort" data-sort="name">Tanggal</th>
                            <th scope="col" class="sort" data-sort="pemasok">Pemasok</th>
                            <th scope="col" class="sort" data-sort="price">Total</th>
                        </tr>
                        </thead>
                        <tbody class="list">
                        @foreach ($pembelians as $key => $pembelian)
                            <tr>
                                <th scope="row"> {{ $key + $pembelians->firstItem() }} </th>
                                <td> {{ $pembelian->id }} </td>
                                <td> {{ date('d-m-Y', strtotime($pembelian->date)) }} </td>
                                <td> {{ $pembelian->pemasok  }} </td>
                                <td> Rp {{ number_format($pembelian->total,2,',','.') }} </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{ $pembelians->links() }}
@endsection
