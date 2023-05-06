<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use Illuminate\Http\Request;

class DesaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $desas = Desa::latest()->paginate(5);

        return view('desa.index', compact('desas'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
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
            'nama' => 'required',
            'kecamatan' => 'required',
            'kabupaten' => 'required',
        ]);

        Desa::create($request->all());

        return redirect()->route('desa.index')
            ->with('success', 'Data berhasil ditambah.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Desa  $desa
     * @return \Illuminate\Http\Response
     */
    public function edit(Desa $desa)
    {
        return view('desa.edit', compact('desa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Desa  $desa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Desa $desa)
    {
        $request->validate([
            'nama' => 'required',
            'kecamatan' => 'required',
            'kabupaten' => 'required',
        ]);

        $desa->update($request->all());

        return redirect()->route('desas.index')
            ->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Desa  $desa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Desa $desa)
    {
        $desa->delete();

        return redirect()->route('desa.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
