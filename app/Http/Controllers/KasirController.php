<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;

use App\Models\User;

class KasirController extends Controller
{

    public function __construct()
    {
        $this->middleware(function($request, $next){
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
        $kasir = User::where('role', '=', 'kasir')->orderBy('name', 'asc')->paginate(6);

        return view('pages.kasir.index')->with([
            'kasirs' => $kasir
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.kasir.create');
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()]
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'kasir'
        ]);

        return redirect()->route('kasir.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kasir = User::findOrFail($id);

        return view('pages.kasir.edit')->with([
            'kasir' => $kasir
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $old_email = User::findOrFail($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()]
        ]);

        if ($request->email !== $old_email->email) {
            $request->validate([
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users']
            ]);
        }

        User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'kasir'
        ]);

        return redirect()->route('kasir.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);

        return redirect()->route('kasir.index');
    }
}
