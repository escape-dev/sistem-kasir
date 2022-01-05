@extends('layouts.apps.kasir.kasir-global')

@section('breadcrumb')
    <h6 class="h2 text-white d-inline-block mb-0">Default</h6>
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="#">Dashboards</a></li>
            <li class="breadcrumb-item active" aria-current="page">Default</li>
        </ol>
    </nav>
@endsection

@section('card-stats')
<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Total traffic</h5>
                        <span class="h2 font-weight-bold mb-0">350,897</span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                            <i class="ni ni-active-40"></i>
                        </div>
                    </div>
                </div>
                <p class="mt-3 mb-0 text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                    <span class="text-nowrap">Since last month</span>
                </p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">New users</h5>
                        <span class="h2 font-weight-bold mb-0">2,356</span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                            <i class="ni ni-chart-pie-35"></i>
                        </div>
                    </div>
                </div>
                <p class="mt-3 mb-0 text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                    <span class="text-nowrap">Since last month</span>
                </p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Sales</h5>
                        <span class="h2 font-weight-bold mb-0">924</span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                            <i class="ni ni-money-coins"></i>
                        </div>
                    </div>
                </div>
                <p class="mt-3 mb-0 text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                    <span class="text-nowrap">Since last month</span>
                </p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Performance</h5>
                        <span class="h2 font-weight-bold mb-0">49,65%</span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                            <i class="ni ni-chart-bar-32"></i>
                        </div>
                    </div>
                </div>
                <p class="mt-3 mb-0 text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                    <span class="text-nowrap">Since last month</span>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">Stok Menipis</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <!-- Projects table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col" class="sort" data-sort="name">Name</th>
                                    <th scope="col" class="sort" data-sort="price">Price</th>
                                    <th scope="col" class="sort" data-sort="stock">Stock</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @foreach ($barangs as $key => $barang)
                                <tr>
                                    <th scope="row"> {{ $key + 1 }} </th>
                                    <td> {{ $barang->name }} </td>
                                    <td> Rp {{ number_format($barang->price,2,',','.') }} </td>
                                    <td> {{ $barang->stok }} </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">Social traffic</h3>
                    </div>
                    <div class="col text-right">
                        <a href="#!" class="btn btn-sm btn-primary">See all</a>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <!-- Projects table -->
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Referral</th>
                            <th scope="col">Visitors</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">
                                Facebook
                            </th>
                            <td>
                                1,480
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="mr-2">60%</span>
                                    <div>
                                        <div class="progress">
                                            <div class="progress-bar bg-gradient-danger" role="progressbar"
                                                aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                                style="width: 60%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                Facebook
                            </th>
                            <td>
                                5,480
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="mr-2">70%</span>
                                    <div>
                                        <div class="progress">
                                            <div class="progress-bar bg-gradient-success" role="progressbar"
                                                aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"
                                                style="width: 70%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                Google
                            </th>
                            <td>
                                4,807
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="mr-2">80%</span>
                                    <div>
                                        <div class="progress">
                                            <div class="progress-bar bg-gradient-primary" role="progressbar"
                                                aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"
                                                style="width: 80%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                Instagram
                            </th>
                            <td>
                                3,678
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="mr-2">75%</span>
                                    <div>
                                        <div class="progress">
                                            <div class="progress-bar bg-gradient-info" role="progressbar"
                                                aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
                                                style="width: 75%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                twitter
                            </th>
                            <td>
                                2,645
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="mr-2">30%</span>
                                    <div>
                                        <div class="progress">
                                            <div class="progress-bar bg-gradient-warning" role="progressbar"
                                                aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"
                                                style="width: 30%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection