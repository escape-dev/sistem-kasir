<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\DetailPembelian;
use App\Models\DetailPenjualan;
use App\Http\Requests\BarangStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use RealRashid\SweetAlert\Facades\Alert;

class BarangController extends Controller
{

    public function __construct()
    {
        $this->middleware(function($request, $next) {
            if (Gate::allows('isAdmin')) return $next($request);

            abort(403, 'Anda tidak memiliki cukup hak akses');
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barangs = Barang::orderBy('name', 'asc')->paginate(6);

        return view('pages.barang.index')->with([
            'barangs' => $barangs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.barang.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BarangStoreRequest $request)
    {
        $request->validated();

        Barang::create([
            'name' => $request->name,
            'price' => $request->price,
            'stok' => $request->stok
        ]);

        return redirect()->route('barang.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit($barang)
    {
        $barang = Barang::findOrFail($barang);

        return view('pages.barang.edit')->with([
            'barang' => $barang
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(BarangStoreRequest $request, $barang)
    {
        $request->validated();

        Barang::where('id', $barang)->update([
            'name' => $request->name,
            'price' => $request->price,
            'stok' => $request->stok
        ]);

        return redirect()->route('barang.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy($barang)
    {
        $penjualan = DetailPenjualan::where('barang_id', '=', $barang)->count();
        $pembelian = DetailPembelian::where('barang_id', '=', $barang)->count();

        switch (True) {
            case $penjualan > 0 || $pembelian > 0 :
                Alert::error('Error', 'Data masih dipakai');
                break;
            default :
                Barang::destroy($barang);
        }

        return redirect()->route('barang.index');
    }
}
