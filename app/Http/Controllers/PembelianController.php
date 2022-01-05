<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;

use App\Models\Barang;
use App\Models\Pemasok;
use App\Models\Pembelian;
use App\Models\DetailPembelian;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PembelianController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            if (Gate::allows('isKasir')) return $next($request);

            abort(403, 'Anda tidak memiliki cukup hak akses');
        });
    }

    public function pemasok()
    {
        $pemasoks = Pemasok::cursor();

        return view('pages.pembelian.pemasok')->with([
            'pemasoks' => $pemasoks
        ]);
    }

    public function create(Request $request)
    {
        $user_id = Auth::user()->id;
        $date = new DateTime("now", new DateTimeZone('Asia/Jakarta'));

        $request->validate([
            'pemasok' => 'required'
        ]);

        $pembelian = Pembelian::create([
            'user_id' => $user_id,
            'pemasok_id' => $request->pemasok,
            'date' => $date
        ]);

        return redirect()->route('pembelian', $pembelian);
    }


    public function pembelian($pembelian)
    {
        $nota = Pembelian::with('pemasok')->findOrFail($pembelian);
        $detail_pembelian = DetailPembelian::where('pembelian_id', '=', $pembelian)->with('barang')->get();
        $total_harga = $detail_pembelian->sum->subtotal;
        $barangs = Barang::cursor();
        $tanggal = date('d-m-Y', strtotime($nota->date));

        return view('pages.pembelian.index')->with([
            'pembelian' => $nota,
            'tanggal' => $tanggal,
            'total' => $total_harga,
            'detail_pembelian' => $detail_pembelian,
            'barangs' => $barangs
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'pembelian' => 'required',
            'barang' => 'required',
            'qty' => 'required|numeric'
        ]);

        $harga_barang = Barang::findOrFail($request->barang);
        $subtotal = $request->qty * $harga_barang->price;

        DetailPembelian::create([
            'pembelian_id' => $request->pembelian,
            'barang_id' => $request->barang,
            'subtotal' => $subtotal,
            'qty' => $request->qty
        ]);

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $pembelian)
    {
        $request->validate([
            'qty' => 'required|numeric'
        ]);

        $subtotal = $request->qty * $request->price;

        DetailPembelian::where('id', $pembelian)->update([
            'qty' => $request->qty,
            'subtotal' => $subtotal
        ]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function destroy($pembelian)
    {
        DetailPembelian::destroy($pembelian);

        return redirect()->back();
    }
}
