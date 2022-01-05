<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;

use App\Models\Barang;
use App\Models\Penjualan;
use App\Models\DetailPenjualan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use RealRashid\SweetAlert\Facades\Alert;

class PenjualanController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            if (Gate::allows('isKasir')) return $next($request);

            abort(403, 'Anda tidak memiliki cukup hak akses');
        });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $penjualan = Penjualan::latest()->first();

        if (empty($penjualan)) {
            $user_id = Auth::user()->id;
            $date = new DateTime("now", new DateTimeZone('Asia/Jakarta'));

            $id_penjualan = Penjualan::create([
                'user_id' => $user_id,
                'date' => $date
            ]);
        } else {
            $id_penjualan = $penjualan->id;
        }

        return redirect()->route('penjualan',  $id_penjualan);
    }

    public function penjualan($id_penjualan)
    {
        $nota = Penjualan::findOrFail($id_penjualan);
        $detail_penjualan = DetailPenjualan::where('penjualan_id', '=', $id_penjualan)->with('barang')->get();
        $total_harga = $detail_penjualan->sum->subtotal;
        $barangs = Barang::cursor();
        $tanggal = date('d-m-Y', strtotime($nota->date));

        return view('pages.penjualan.index')->with([
            'penjualan' => $nota,
            'tanggal' => $tanggal,
            'total' => $total_harga,
            'detail_penjualans' => $detail_penjualan,
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
            'penjualan' => 'required',
            'barang' => 'required',
            'qty' => 'required|numeric'
        ]);

        $barang = Barang::findOrFail($request->barang);
        $subtotal = $request->qty * $barang->price;

        switch (True){
            case $barang->stok > $request->qty:
                DetailPenjualan::create([
                    'penjualan_id' => $request->penjualan,
                    'barang_id' => $request->barang,
                    'subtotal' => $subtotal,
                    'qty' => $request->qty
                ]);
                break;
            default :
                Alert::error('Error', 'Stok tidak cukup');
        }

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $penjualan)
    {
        $request->validate([
            'qty' => 'required|numeric'
        ]);

        $subtotal = $request->qty * $request->price;

        switch (True){
            case $request->stok > $request->qty:
                DetailPenjualan::where('id', $penjualan)->update([
                    'qty' => $request->qty,
                    'subtotal' => $subtotal
                ]);
                break;
            default :
                Alert::error('Error', 'Stok tidak cukup');
        }

        return redirect()->back();
    }

    public function simpan($penjualan)
    {
        $detail_penjualan = DetailPenjualan::where('penjualan_id', '=', $penjualan)->get();

        if (!empty($detail_penjualan)) {
            foreach ($detail_penjualan as $penjualan) {
                $barang = Barang::findOrFail($penjualan->barang_id);

                $stok = $barang->stok - $penjualan->qty;
                Barang::where('id', $penjualan->barang_id)->update([
                    'stok' => $stok
                ]);
            }
        }

        $user_id = Auth::user()->id;
        $date = new DateTime("now", new DateTimeZone('Asia/Jakarta'));

        $id_penjualan = Penjualan::create([
            'user_id' => $user_id,
            'date' => $date
        ]);

        return redirect()->route('penjualan',  $id_penjualan);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function destroy($penjualan)
    {
        DetailPenjualan::destroy($penjualan);

        return redirect()->back();
    }
}
