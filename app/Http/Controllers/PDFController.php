<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\MatriksKeputusan;
use App\Models\NilaiPreferensi;
use App\Models\NormalisasiBobot;
use App\Models\Penilaian;
use Barryvdh\DomPDF\Facade\PDF;

class PDFController extends Controller
{
    public function pdf_hasil()
    {
        $judul = 'Laporan Hasil Akhir';
        $tabelPenilaian = Penilaian::with('kriteria', 'subKriteria', 'alternatif')->get();
        $tabelNormalisasi = NormalisasiBobot::with('kriteria')->get();
        $tabelMatriksKeputusan = MatriksKeputusan::with('kriteria', 'alternatif')->get();
        $tabelNilaiPreferensi = NilaiPreferensi::with('kriteria', 'alternatif')->get();
        $tabelPerankingan = NilaiPreferensi::query()
            ->join('alternatif as a', 'a.id', '=', 'nilai_preferensi.alternatif_id')
            ->selectRaw("a.kode, a.alternatif, SUM(nilai) as nilai")
            ->groupBy('a.kode', 'a.alternatif')
            ->orderBy('nilai', 'desc')
            ->get();
        $kriteria = Kriteria::orderBy('id', 'asc')->get(['id', 'kriteria']);
        $alternatif = Alternatif::orderBy('id', 'asc')->get(['id', 'alternatif']);

        $pdf = PDF::setOptions(['defaultFont' => 'sans-serif'])->loadview('dashboard.pdf.hasil_akhir', [
            'judul' => $judul,
            'tabelPenilaian' => $tabelPenilaian,
            'tabelNormalisasi' => $tabelNormalisasi,
            'tabelMatriksKeputusan' => $tabelMatriksKeputusan,
            'tabelNilaiPreferensi' => $tabelNilaiPreferensi,
            'tabelPerankingan' => $tabelPerankingan,
            'kriteria' => $kriteria,
            'alternatif' => $alternatif,
        ]);

        // return $pdf->download('laporan-penilaian.pdf');
        return $pdf->stream();
    }
}
