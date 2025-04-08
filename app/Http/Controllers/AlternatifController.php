<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlternatifRequest;
use App\Http\Resources\AlternatifResource;
use App\Imports\AlternatifImport;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\MatriksKeputusan;
use App\Models\NilaiPreferensi;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AlternatifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Alternatif";
        $alternatif = AlternatifResource::collection(Alternatif::orderBy('kode', 'asc')->get());
        $lastKode = Alternatif::orderBy('kode', 'desc')->first();
        if ($lastKode) {
            $kode = "A" . str_pad((int) substr($lastKode->kode, 1) + 1, 5, '0', STR_PAD_LEFT);
        } else {
            $kode = "A00001";
        }
        return view('dashboard.alternatif.index', compact('title', 'alternatif', 'kode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AlternatifRequest $request)
    {
        $validated = $request->validated();

        $alternatif = Alternatif::create($validated);
        $createPenilaian = true;
        $kriteria = Kriteria::get('id');
        if ($kriteria->first()) {
            foreach ($kriteria as $item) {
                $createPenilaian = Penilaian::create([
                    'alternatif_id' => $alternatif->id,
                    'kriteria_id' => $item->id,
                    'sub_kriteria_id' => null,
                ]);
            }
        }

        if ($createPenilaian) {
            return to_route('alternatif')->with('success', 'Alternatif Berhasil Disimpan');
        } else {
            return to_route('alternatif')->with('error', 'Alternatif Gagal Disimpan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        return new AlternatifResource(Alternatif::find($request->alternatif_id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        return new AlternatifResource(Alternatif::find($request->alternatif_id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AlternatifRequest $request)
    {
        $validated = $request->validated();

        $perbarui = Alternatif::where('id', $request->id)->update($validated);
        if ($perbarui) {
            return to_route('alternatif')->with('success', 'Alternatif Berhasil Diperbarui');
        } else {
            return to_route('alternatif')->with('error', 'Alternatif Gagal Diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        $penilaian = Penilaian::where('alternatif_id', $request->alternatif_id)->first();
        if ($penilaian) {
            Penilaian::where('alternatif_id', $request->alternatif_id)->delete();
        }
        MatriksKeputusan::where('alternatif_id', $request->alternatif_id)->delete();
        NilaiPreferensi::where('alternatif_id', $request->alternatif_id)->delete();
        $hapus = Alternatif::where('id', $request->alternatif_id)->delete();
        if ($hapus) {
            return to_route('alternatif')->with('success', 'Alternatif Berhasil Dihapus');
        } else {
            return to_route('alternatif')->with('error', 'Alternatif Gagal Dihapus');
        }
    }

    public function import(Request $request)
    {
        $request->validate([
            'import_data' => 'required|mimes:xls,xlsx'
        ]);

        $file = $request->file('import_data');
        Excel::import(new AlternatifImport, $file);

        $kriteria = Kriteria::get('id');
        $alternatif = Alternatif::get('id');
        $createPenilaian = true;
        if ($kriteria->first()) {
            Penilaian::truncate();
            foreach ($kriteria as $value) {
                foreach ($alternatif as $item) {
                    $createPenilaian = Penilaian::create([
                        'alternatif_id' => $item->id,
                        'kriteria_id' => $value->id,
                        'sub_kriteria_id' => null,
                    ]);
                }
            }
        }

        if ($createPenilaian) {
            return to_route('alternatif')->with('success', 'Alternatif Berhasil Disimpan');
        } else {
            return to_route('alternatif')->with('error', 'Alternatif Gagal Disimpan');
        }
    }
}
