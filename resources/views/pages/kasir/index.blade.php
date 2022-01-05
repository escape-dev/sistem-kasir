@extends('layouts.apps.admin.admin-global')

@section('breadcrumb')
<h6 class="h2 text-white d-inline-block mb-0">Tables</h6>
<nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Tables</a></li>
        <li class="breadcrumb-item active" aria-current="page">Kasir</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row">
    <div class="col">
        <div class="card bg-default shadow">
            <div class="card-header bg-transparent border-0">
                <a href="{{ route('kasir.create') }}" class="btn btn-primary"> Tambah Kasir </a>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center table-dark table-flush">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col" class="sort" data-sort="name">Name</th>
                            <th scope="col" class="sort" data-sort="price">Email</th>
                            <th scope="col" class="sort" data-sort="stock">Role</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @foreach ($kasirs as $key => $kasir)
                        <tr>
                            <th scope="row"> {{ $key + $kasirs->firstItem() }} </th>
                            <td> {{ $kasir->name }} </td>
                            <td> {{ $kasir->email }} </td>
                            <td> {{ $kasir->role }} </td>
                            <td>
                                <a href="{{ route('kasir.edit', $kasir->id) }}"
                                    class="btn btn-warning waves-effect waves-light">Edit</a>
                                <form class="d-inline" onsubmit="return confirm('Data will be Deleted, Are you sure?')"
                                    action="{{ route('kasir.destroy', $kasir->id) }}" method="post">
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
{{ $kasirs->links() }}
@endsection