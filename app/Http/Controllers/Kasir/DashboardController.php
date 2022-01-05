<?php

namespace App\Http\Controllers\Kasir;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Models\Barang;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(function($request, $next){

            if(Gate::allows('isKasir')) return $next($request);

            abort(403, 'Anda tidak memiliki cukup hak akses');
        });
    }

    public function index()
    {
        $barangs = Barang::where('stok', '<=', 5)->cursor();

        return view('pages.dashboard-kasir')->with([
            'barangs' => $barangs
        ]);
    }
}
