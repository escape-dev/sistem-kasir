<?php

namespace App\Http\Controllers\Admin;

use DateTime;
use DateTimeZone;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Barang;
use App\Models\Pemasok;
use App\Models\Penjualan;
use App\Models\DetailPembelian;
use App\Models\DetailPenjualan;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next){

            if(Gate::allows('isAdmin')) return $next($request);

            abort(403, 'Anda tidak memiliki cukup hak akses');
        });
    }

    public function index() {
        $now = new DateTime("now", new DateTimeZone('Asia/Jakarta'));
        $past = new DateTime("now", new DateTimeZone('Asia/Jakarta'));
        date_add($past, date_interval_create_from_date_string('-24 hours'));
        $now_format = date_format($past, 'Y-m-d H:i:s');
        $past_format = date_format($now, 'Y-m-d H:i:s');

        $barangs = Barang::where('stok', '<=', 5)->cursor();
        $admins = User::where('role', '=', 'admin')->cursor();
        $kasirs = User::where('role', '=', 'kasir')->cursor();
        $penjualan = DetailPenjualan::sum('subtotal');
        $pembelian = DetailPembelian::sum('subtotal');
        $pemasok = Pemasok::count();

        $penjualan_terkini = DetailPenjualan::whereBetween('created_at', [$now_format, $past_format])->sum('subtotal');

        return view('pages.dashboard-admin')->with([
            'barangs' => $barangs,
            'admins' => $admins,
            'kasirs' => $kasirs,
            'penjualan' => $penjualan,
            'pembelian' => $pembelian,
            'pemasok' => $pemasok,
            'penjualan_terkini' => $penjualan_terkini
        ]);
    }

    public function data_penjualan() {
        $penjualan = Penjualan::join('detail_penjualans', 'penjualans.id', '=', 'detail_penjualans.penjualan_id')
            ->select('penjualans.id', 'date', DB::raw('sum(subtotal) as total'))
            ->groupBy('penjualans.id', 'date')
            ->paginate(5);

        return view('pages.penjualan.laporan-penjualan')->with([
            'penjualans' => $penjualan
        ]);
    }
}
