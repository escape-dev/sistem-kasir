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
        $barangs  = Barang::cursor(); 
        $items    = Cart::session(Auth::user()->id)->getContent();
        $total    = Cart::session(Auth::user()->id)->getTotal();
        $tanggal  = now()->format('d-m-Y');

        return view('pages.penjualan.index')->with([
            'tanggal'   => $tanggal,
            'items'     => $items,
            'total'     => $total,
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
            case $barang->stok > $request->quantity:
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

    public function updateCart(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|numeric'
        ]);

        $barang = Barang::findOrFail($request->id);
        $item   = Cart::session(Auth::user()->id)->get($id);

        switch (True){
            case $barang->stok > $request->quantity:
                $item->quantity = $request->quantity;
                break;
            default :
                Alert::error('Error', 'Stok tidak cukup');
        }



        return redirect()->back();
    }

    public function removeCart($id) 
    {
        Cart::session(Auth::user()->id)->remove($id);

        return redirect()->back();
    }

    public function saveCart(Request $request)
    {
        $items     = Cart::session(Auth::user()->id)->getContent();
        $user_id   = Auth::user()->id;
        $penjualan = Penjualan::createPenjualan($user_id, $items);

        Cart::session(Auth::user()->id)->clear();

        return redirect()->back();
    }
}