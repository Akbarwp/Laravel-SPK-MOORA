<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\NilaiPreferensi;
use App\Models\SubKriteria;

class DashboardController extends Controller
{
    public function index()
    {
        $title = "Dashboard";

        $kriteria = Kriteria::count();
        $subKriteria = SubKriteria::count();
        $alternatif = Alternatif::count();

        $nilaiPreferensi = NilaiPreferensi::selectRaw('alternatif_id, SUM(nilai) as nilai')->groupBy('alternatif_id')->orderBy('alternatif_id', 'asc')->get();

        return view('dashboard.index', compact('title', 'kriteria', 'subKriteria', 'alternatif', 'nilaiPreferensi'));
    }

    public function hasilAkhir()
    {
        $title = "Hasil Preferensi";
        $nilaiPreferensi = NilaiPreferensi::query()
            ->join('alternatif as a', 'a.id', '=', 'nilai_preferensi.alternatif_id')
            ->selectRaw("a.kode, a.alternatif, SUM(nilai) as nilai")
            ->groupBy('a.kode', 'a.alternatif')
            ->orderBy('nilai', 'desc')
            ->get();
        return view('dashboard.hasil-akhir.index', compact('title', 'nilaiPreferensi'));
    }
}
