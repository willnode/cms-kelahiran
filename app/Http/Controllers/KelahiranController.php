<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Kelahiran;
use App\Models\Periode;
use Illuminate\Http\Request;

class KelahiranController extends Controller
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
        $bulan = $_GET['bulan'] ?? date('m');
        $tahun = $_GET['tahun'] ?? date('Y');
        $desa = $_GET['desa'] ?? '';
        $cari = $_GET['cari'] ?? '';
        if (!$desa && ($user = auth()->user())) {
            $desa = max($user->desa_id, 1);
            return redirect()->route('kelahiran.index', ['desa' => $desa, 'bulan' => $bulan, 'tahun' => $tahun]);
        }

        $periode_nama = $tahun . '-' . str_pad($bulan, 2, '0', STR_PAD_LEFT);
        $periode = Periode::firstOrNew(
            ['nama' => $periode_nama],
            ['bulan' => $bulan, 'tahun' => $tahun]
        );
        $model = Kelahiran::where(['periode_id' => $periode->id, 'desa_id' => $desa]);
        if ($cari) {
            $model = $model->where('nama_anak', 'like', '%' . $cari . '%');
            $model = $model->orWhere('nama_ayah', 'like', '%' . $cari . '%');
            $model = $model->orWhere('nama_ibu', 'like', '%' . $cari . '%');
        }

        $kelahirans = $model->latest()->paginate(50);
        $bulans = [1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $desas = Desa::all();

        return view('kelahiran.index', compact('kelahirans', 'desas', 'bulans', 'bulan', 'tahun', 'desa', 'cari'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bulan = $_GET['bulan'] ?? date('m');
        $tahun = $_GET['tahun'] ?? date('Y');
        $periode_nama = $tahun . '-' . str_pad($bulan, 2, '0', STR_PAD_LEFT);
        $periode = Periode::firstOrNew(
            ['nama' => $periode_nama],
            ['bulan' => $bulan, 'tahun' => $tahun]
        );
        $bulans = [1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $desas = Desa::all();

        $kelahiran = (object)[
            'id' => null,
            'nama_anak' => '',
            'nama_ayah' => '',
            'nama_ibu' => '',
            'desa_id' => $_GET['desa'] ?? '',
            'periode_id' => $periode->id,
            'rt' => '',
            'rw' => '',
            'tempat_lahir' => env('APP_KABUPATEN', ''),
            'tanggal_lahir' => date('Y-m-d'),
            'umur_ibu' => '',
            'anak_ke' => '',
            'jumlah_anak_hidup' => '',
        ];

        return view('kelahiran.edit', compact('kelahiran', 'desas', 'bulans', 'periode'));
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
            'nama_anak' => 'required',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
            'desa_id' => 'required',
            'umur_ibu' => 'required|integer',
            'rt' => 'required|integer',
            'rw' => 'required|integer',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required',
            'jumlah_anak_hidup' => 'required|integer',
        ]);

        $data = $request->all();

        $tahun = substr($data['tanggal_lahir'], 0, 4);
        $bulan = substr($data['tanggal_lahir'], 5, 2);
        $periode_nama = $tahun . '-' . $bulan;
        $periode = Periode::firstOrCreate(
            ['nama' => $periode_nama],
            ['bulan' => $bulan, 'tahun' => $tahun]
        );
        $data['periode_id'] = $periode->id;

        Kelahiran::create($data);

        return redirect()->route('kelahiran.index')
            ->with('success', 'Data berhasil ditambah.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kelahiran  $kelahiran
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelahiran $kelahiran)
    {
        $bulans = [1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $desas = Desa::all();

        return view('kelahiran.edit', compact('kelahiran', 'desas', 'bulans'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kelahiran  $kelahiran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kelahiran $kelahiran)
    {
        $request->validate([
            'nama_anak' => 'required',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
            'desa_id' => 'required',
            'umur_ibu' => 'required|integer',
            'rt' => 'required|integer',
            'rw' => 'required|integer',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required',
            'jumlah_anak_hidup' => 'required|integer',
        ]);

        $data = $request->all();

        $tahun = substr($data['tanggal_lahir'], 0, 4);
        $bulan = substr($data['tanggal_lahir'], 5, 2);
        $periode_nama = $tahun . '-' . $bulan;
        $periode = Periode::firstOrCreate(
            ['nama' => $periode_nama],
            ['bulan' => $bulan, 'tahun' => $tahun]
        );
        $data['periode_id'] = $periode->id;

        $kelahiran->update($data);

        return redirect()->route('kelahirans.index')
            ->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kelahiran  $kelahiran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelahiran $kelahiran)
    {
        $kelahiran->delete();

        return redirect()->route('kelahiran.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
