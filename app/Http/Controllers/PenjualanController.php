<?php

namespace App\Http\Controllers;

use Cart;
use DateTime;
use DateTimeZone;

use App\Models\Barang;
use App\Models\Penjualan;
use App\Models\DetailPenjualan;

use Illuminate\Support\Str;
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

    public function index() 
    {
        $nota     = Str::uuid()->toString();
        $tanggal  = now()->format('d-m-Y');
        $barangs  = Barang::cursor(); 
        $items    = Cart::session(Auth::user()->id)->getContent();
        $subtotal = Cart::session(Auth::user()->id)->getSubTotal();
        $total    = Cart::session(Auth::user()->id)->getTotal();

        return view('pages.penjualan.index')->with([
            'nota'      => $nota,
            'tanggal'   => $tanggal,
            'items'     => $items,
            'total'     => $total,
            'subtotal'  => $subtotal,
            'barangs'   => $barangs
        ]);
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'id'       => 'required',
            'quantity' => 'required|numeric',
        ]);

        $barang = Barang::findOrFail($request->id);

        switch (True){
            case $barang->stok > $request->qty:
                Cart::session(Auth::user()->id)->add([
                    'id'        => $request->id,
                    'name'      => $barang->name,
                    'price'     => $barang->price,
                    'quantity'  => $request->quantity
                ]);
                break;
            default :
                Alert::error('Error', 'Stok tidak cukup');
        }

        return redirect()->back();
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
        $nota             = Str::uuid()->toString();
        $detail_penjualan = DetailPenjualan::with('barang')->get();
        $total_harga      = $detail_penjualan->sum->subtotal;
        $barangs          = Barang::cursor();
        $tanggal          = now();

        return view('pages.penjualan.index')->with([
            'nota'              => $nota,
            'tanggal'           => $tanggal,
            'total'             => $total_harga,
            'detail_penjualans' => $detail_penjualan,
            'barangs'           => $barangs
        ]);
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
