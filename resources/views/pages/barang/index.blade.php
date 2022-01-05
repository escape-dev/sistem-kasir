@extends('layouts.apps.admin.admin-global')

@section('breadcrumb')
<h6 class="h2 text-white d-inline-block mb-0">Tables</h6>
<nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Tables</a></li>
        <li class="breadcrumb-item active" aria-current="page">Barang</li>
    </ol>
</nav>
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="card bg-default shadow">
                <div class="card-header bg-transparent border-0">
                    <a href="{{ route('barang.create') }}" class="btn btn-primary"> Tambah Barang </a>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-dark table-flush">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col" class="sort" data-sort="name">Name</th>
                                <th scope="col" class="sort" data-sort="price">Price</th>
                                <th scope="col" class="sort" data-sort="stock">Stock</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @foreach ($barangs as $key => $barang)
                                <tr>
                                    <th scope="row"> {{ $key + $barangs->firstItem() }} </th>
                                    <td> {{ $barang->name }} </td>
                                    <td>
                                        Rp {{ number_format($barang->price,2,',','.') }} 
                                    </td>
                                    <td> {{ $barang->stok }} </td>
                                    <td>
                                        <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-warning waves-effect waves-light">Edit</a>
                                        <form class="d-inline" onsubmit="return confirm('Data will be Deleted, Are you sure?')"
                                            action="{{ route('barang.destroy', $barang->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <input type="submit" class="btn btn-danger waves-effect waves-light" value="Delete">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{ $barangs->links() }}
@endsection