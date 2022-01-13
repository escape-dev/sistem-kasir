<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pembelian;
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
        $past->modify('-7 days');
        $now_format = date_format($now, 'Y-m-d');
        $past_format = date_format($past, 'Y-m-d');

        $barangs = Barang::where('stok', '<=', 5)->cursor();
        $admins = User::where('role', '=', 'admin')->cursor();
        $kasirs = User::where('role', '=', 'kasir')->cursor();
        $penjualan = DetailPenjualan::sum('subtotal');
        $pembelian = DetailPembelian::sum('subtotal');
        $pemasok = Pemasok::count();

//        dd($past_format, $now_format);

        $data = Penjualan::join('detail_penjualans', 'penjualans.id', '=', 'detail_penjualans.penjualan_id')
            ->select(DB::raw('date(date) as tanggal'), DB::raw('sum(subtotal) as total'))
            ->whereBetween(DB::raw('date(date)'), [$past_format, $now_format])
            ->groupBy('tanggal')
            ->get();

        $data_chart[] = null;
        $penjualan_terkini = $data->sum->total;

        if ($data) {
            foreach ($data as $chrt) {
                $data_chart['label'][] = $chrt->tanggal;
                $data_chart['data'][] = $chrt->total;
            }
        }

        $chart = json_encode($data_chart);

//        dd($chart);

        return view('pages.dashboard-admin')->with([
            'barangs' => $barangs,
            'admins' => $admins,
            'kasirs' => $kasirs,
            'penjualan' => $penjualan,
            'pembelian' => $pembelian,
            'pemasok' => $pemasok,
            'data_chart' => $chart,
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

    public function data_pembelian() {
        $pembelian = Pembelian::join('detail_pembelians', 'pembelians.id', '=', 'detail_pembelians.pembelian_id')
            ->join('pemasoks', 'pembelians.pemasok_id', '=', 'pemasoks.id')
            ->select('pembelians.id', 'date', 'pemasoks.name as pemasok', DB::raw('sum(subtotal) as total'))
            ->groupBy('pembelians.id', 'date', 'pemasoks.name')
            ->paginate(5);

        return view('pages.pembelian.laporan-pembelian')->with([
            'pembelians' => $pembelian
        ]);
    }
}
