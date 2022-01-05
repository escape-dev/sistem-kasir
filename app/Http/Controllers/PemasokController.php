<?php

namespace App\Http\Controllers;

use App\Models\Pemasok;
use App\Models\Pembelian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use RealRashid\SweetAlert\Facades\Alert;

class PemasokController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
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
        $pemasok = Pemasok::orderBy('name', 'asc')->paginate(6);

        return view('pages.pemasok.index')->with([
            'pemasoks' => $pemasok
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.pemasok.create');
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
            'name' => 'required|unique:pemasoks,name',
            'address' => 'required',
            'telephone' => 'required|numeric'
        ]);

        Pemasok::create([
            'name' => $request->name,
            'address' => $request->address,
            'telephone' => $request->telephone
        ]);

        return redirect()->route('pemasok.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pemasok  $pemasok
     * @return \Illuminate\Http\Response
     */
    public function show(Pemasok $pemasok)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pemasok  $pemasok
     * @return \Illuminate\Http\Response
     */
    public function edit($pemasok)
    {
        $pemasok = Pemasok::findOrFail($pemasok);

        return view('pages.pemasok.edit')->with([
            'pemasok' => $pemasok
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pemasok  $pemasok
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $pemasok)
    {
        $old_name = Pemasok::findOrFail($pemasok);

        $request->validate([
            'address' => 'required',
            'telephone' => 'required|numeric'
        ]);

        if ($request->name !== $old_name->name) {
            $request->validate([
                'name' => 'required|unique:pemasoks,name'
            ]);
        }

        Pemasok::where('id', $pemasok)->update([
            'name' => $request->name,
            'address' => $request->address,
            'telephone' => $request->telephone
        ]);

        return redirect()->route('pemasok.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pemasok  $pemasok
     * @return \Illuminate\Http\Response
     */
    public function destroy($pemasok)
    {
        $pembelian = Pembelian::where('pemasok_id', '=', $pemasok)->count();

        switch (True) {
            case $pembelian > 0 :
                Alert::error('Error', 'Data masih dipakai');
                break;
            default :
                Pemasok::destroy($pemasok);
        }

        return redirect()->route('pemasok.index');
    }
}
