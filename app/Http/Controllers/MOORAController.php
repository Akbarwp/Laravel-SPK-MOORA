<?php

namespace App\Http\Controllers;

use App\Http\Resources\AlternatifResource;
use App\Http\Resources\KriteriaResource;
use App\Http\Resources\MatriksKeputusanResource;
use App\Http\Resources\NilaiPreferensiResource;
use App\Http\Resources\NormalisasiBobotResource;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\MatriksKeputusan;
use App\Models\NilaiPreferensi;
use App\Models\NormalisasiBobot;
use App\Models\Penilaian;
use Illuminate\Http\Request;

class MOORAController extends Controller
{
    public function perhitunganNormalisasiBobot()
    {
        $kriteria = KriteriaResource::collection(Kriteria::orderBy('kode', 'asc')->get());
        $sumBobot = $kriteria->sum('bobot');
        NormalisasiBobot::truncate();
        foreach ($kriteria as $item) {
            $createNormalisasi = NormalisasiBobot::create([
                'kriteria_id' => $item->id,
                'normalisasi' => $item->bobot / $sumBobot,
            ]);
        }
    }

    public function perhitunganMatriksKeputusan()
    {
        $kriteria = KriteriaResource::collection(Kriteria::orderBy('kode', 'asc')->get());
        $alternatif = AlternatifResource::collection(Alternatif::orderBy('kode', 'asc')->get());
        MatriksKeputusan::truncate();

        foreach ($alternatif as $item) {
            foreach ($kriteria as $value) {
                $subKriteria = Penilaian::where('kriteria_id', $value->id)->where('alternatif_id', $item->id)->first()->subKriteria->bobot;
                $sumKriteria = Penilaian::query()
                    ->join('kriteria as k', 'penilaian.kriteria_id', '=', 'k.id')
                    ->join('sub_kriteria as sk', 'penilaian.sub_kriteria_id', '=', 'sk.id')
                    ->where('penilaian.kriteria_id', $value->id)
                    ->selectRaw('penilaian.kriteria_id as kriteria_id, k.kriteria as kriteria_nama, SUM(POWER(sk.bobot, 2)) AS sum_kriteria')
                    ->groupBy('kriteria_id')
                    ->first()->sum_kriteria;

                $matriks = sqrt($sumKriteria);

                $createMatriks = MatriksKeputusan::create([
                    'alternatif_id' => $item->id,
                    'kriteria_id' => $value->id,
                    'nilai' => $subKriteria / $matriks,
                ]);
            }
        }
    }

    public function perhitunganNilaiPreferensi()
    {
        $kriteria = KriteriaResource::collection(Kriteria::orderBy('kode', 'asc')->get());
        $alternatif = AlternatifResource::collection(Alternatif::orderBy('kode', 'asc')->get());
        NilaiPreferensi::truncate();

        foreach ($alternatif as $item) {
            foreach ($kriteria as $value) {
                $normalisasiBobot = NormalisasiBobot::where('kriteria_id', $value->id)->first()->normalisasi;
                $matriksKeputusan = MatriksKeputusan::where('kriteria_id', $value->id)->where('alternatif_id', $item->id)->first()->nilai;
                $nilai = $normalisasiBobot * $matriksKeputusan;
                $createNilaiPreferensi = NilaiPreferensi::create([
                    'alternatif_id' => $item->id,
                    'kriteria_id' => $value->id,
                    'nilai' => $nilai,
                ]);
            }
        }

        if ($createNilaiPreferensi) {
            return true;
        } else {
            return false;
        }
    }

    public function indexPerhitungan()
    {
        $title = "Perhitungan Metode";

        $normalisasiBobot = NormalisasiBobotResource::collection(NormalisasiBobot::with('kriteria')->orderBy('kriteria_id', 'asc')->get());
        $matriksKeputusan = MatriksKeputusanResource::collection(MatriksKeputusan::orderBy('alternatif_id', 'asc')->orderBy('kriteria_id', 'asc')->get());
        $nilaiPreferensi = NilaiPreferensiResource::collection(NilaiPreferensi::orderBy('alternatif_id', 'asc')->orderBy('kriteria_id', 'asc')->get());

        $alternatif = AlternatifResource::collection(Alternatif::orderBy('kode', 'asc')->get());
        $kriteria = KriteriaResource::collection(Kriteria::orderBy('kode', 'asc')->get());
        $sumBobotKriteria = $kriteria->sum('bobot');

        return view('dashboard.perhitungan.index', compact('title', 'normalisasiBobot', 'matriksKeputusan', 'nilaiPreferensi', 'alternatif', 'kriteria', 'sumBobotKriteria'));
    }

    public function perhitunganMetode()
    {
        $this->perhitunganNormalisasiBobot();
        $this->perhitunganMatriksKeputusan();
        $perhitungan = $this->perhitunganNilaiPreferensi();

        if ($perhitungan) {
            return to_route('perhitungan')->with('success', 'Perhitungan Metode MOORA Berhasil Dilakukan');
        } else {
            return to_route('perhitungan')->with('error', 'Perhitungan Metode MOORA Gagal Dilakukan');
        }
    }
}
