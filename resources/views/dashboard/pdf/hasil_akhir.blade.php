@extends("dashboard.pdf.layouts.app")

@section("container")
    <div class="container mx-auto grid px-6">
        <h2 class="judul-laporan my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            {{ $judul }}
        </h2>
    </div>

    <section class="mt-3">
        <div class="table-pdf mx-auto max-w-screen-xl px-4 lg:px-12">
            {{-- Tabel Penilaian --}}
            <div class="relative mb-7 overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                <div class="d mb-5 flex items-center justify-between p-4">
                    <div class="flex space-x-3">
                        <div class="flex items-center space-x-3">
                            <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200">Penilaian Alternatif</h2>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto p-3">
                    <table id="tabel_data_hasil" class="nowrap stripe hover w-full text-left text-sm text-gray-500 dark:text-gray-400" style="width:100%; padding-top: 1em; padding-bottom: 1em;">
                        <thead class="bg-gray-50 text-xs uppercase text-gray-700">
                            <tr>
                                <th scope="col" class="px-4 py-3">Alternatif</th>
                                @foreach ($kriteria as $item)
                                    <th scope="col" class="px-4 py-3">{{ $item->kriteria }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alternatif as $item)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-4 py-3 font-semibold uppercase text-gray-700 dark:text-gray-400">
                                        {{ $item->alternatif }}
                                    </td>
                                    @foreach ($tabelPenilaian->where("alternatif_id", $item->id) as $value)
                                        <td class="px-4 py-3 font-semibold uppercase text-gray-700 dark:text-gray-400">
                                            {{ $value->subKriteria->sub_kriteria }}
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Tabel Normalisasi Bobot --}}
            <div class="relative mb-7 overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                <div class="d mb-5 flex items-center justify-between p-4">
                    <div class="flex space-x-3">
                        <div class="flex items-center space-x-3">
                            <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200">Hasil Normalisasi Bobot Kriteria</h2>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto p-3">
                    <table id="tabel_data_hasil" class="nowrap stripe hover w-full text-left text-sm text-gray-500 dark:text-gray-400" style="width:100%; padding-top: 1em; padding-bottom: 1em;">
                        <thead class="bg-gray-50 text-xs uppercase text-gray-700">
                            <tr>
                                <th scope="col" class="px-4 py-3">Kode</th>
                                <th scope="col" class="px-4 py-3">Kriteria</th>
                                <th scope="col" class="px-4 py-3">Normalisasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tabelNormalisasi as $item)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-4 py-3 font-semibold uppercase text-gray-700 dark:text-gray-400">
                                        {{ $item->kriteria->kode }}
                                    </td>
                                    <td class="px-4 py-3 font-semibold uppercase text-gray-700 dark:text-gray-400">
                                        {{ $item->kriteria->kriteria }}
                                    </td>
                                    <td class="px-4 py-3 font-semibold uppercase text-gray-700 dark:text-gray-400">
                                        {{ round($item->normalisasi, 3) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Tabel Matriks Keputusan --}}
            <div class="relative mb-7 overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                <div class="d mb-5 flex items-center justify-between p-4">
                    <div class="flex space-x-3">
                        <div class="flex items-center space-x-3">
                            <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200">Hasil Matriks Keputusan</h2>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto p-3">
                    <table id="tabel_data_hasil" class="nowrap stripe hover w-full text-left text-sm text-gray-500 dark:text-gray-400" style="width:100%; padding-top: 1em; padding-bottom: 1em;">
                        <thead class="bg-gray-50 text-xs uppercase text-gray-700">
                            <tr>
                                <th scope="col" class="px-4 py-3">Alternatif</th>
                                @foreach ($kriteria as $item)
                                    <th scope="col" class="px-4 py-3">{{ $item->kriteria }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alternatif as $item)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-4 py-3 font-semibold uppercase text-gray-700 dark:text-gray-400">
                                        {{ $item->alternatif }}
                                    </td>
                                    @foreach ($tabelMatriksKeputusan->where("alternatif_id", $item->id) as $value)
                                        <td class="px-4 py-3 font-semibold uppercase text-gray-700 dark:text-gray-400">
                                            {{ round($value->nilai, 3) }}
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Tabel Nilai Preferensi --}}
            <div class="relative mb-7 overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                <div class="d mb-5 flex items-center justify-between p-4">
                    <div class="flex space-x-3">
                        <div class="flex items-center space-x-3">
                            <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200">Hasil Nilai Preferensi</h2>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto p-3">
                    <table id="tabel_data_hasil" class="nowrap stripe hover w-full text-left text-sm text-gray-500 dark:text-gray-400" style="width:100%; padding-top: 1em; padding-bottom: 1em;">
                        <thead class="bg-gray-50 text-xs uppercase text-gray-700">
                            <tr>
                                <th scope="col" class="px-4 py-3">Alternatif</th>
                                @foreach ($kriteria as $item)
                                    <th scope="col" class="px-4 py-3">{{ $item->kriteria }}</th>
                                @endforeach
                                <th scope="col" class="px-4 py-3">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alternatif as $item)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-4 py-3 font-semibold uppercase text-gray-700 dark:text-gray-400">
                                        {{ $item->alternatif }}
                                    </td>
                                    @foreach ($tabelNilaiPreferensi->where("alternatif_id", $item->id) as $value)
                                        <td class="px-4 py-3 font-semibold uppercase text-gray-700 dark:text-gray-400">
                                            {{ round($value->nilai, 3) }}
                                        </td>
                                    @endforeach
                                    <td class="px-4 py-3 font-semibold uppercase text-gray-700 dark:text-gray-400">
                                        {{ round($tabelNilaiPreferensi->where("alternatif_id", $item->id)->sum("nilai"), 3) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Tabel Perankingan --}}
            <div class="relative mb-7 overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                <div class="d mb-5 flex items-center justify-between p-4">
                    <div class="flex space-x-3">
                        <div class="flex items-center space-x-3">
                            <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200">Perankingan Alternatif</h2>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto p-3">
                    <table id="tabel_data_hasil" class="nowrap stripe hover w-full text-left text-sm text-gray-500 dark:text-gray-400" style="width:100%; padding-top: 1em; padding-bottom: 1em;">
                        <thead class="bg-gray-50 text-xs uppercase text-gray-700">
                            <tr>
                                <th scope="col" class="px-4 py-3">Kode</th>
                                <th scope="col" class="px-4 py-3">Alternatif</th>
                                <th scope="col" class="px-4 py-3">Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tabelPerankingan as $item)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-4 py-3 font-semibold uppercase text-gray-700 dark:text-gray-400">
                                        {{ $item->kode }}
                                    </td>
                                    <td class="px-4 py-3 font-semibold uppercase text-gray-700 dark:text-gray-400">
                                        {{ $item->alternatif }}
                                    </td>
                                    <td class="px-4 py-3 font-semibold uppercase text-gray-700 dark:text-gray-400">
                                        {{ round($item->nilai, 3) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div>
                    @php
                        $topRanking = $tabelPerankingan->first();
                    @endphp
                    <h2>Simpulan</h2>
                    <p>Berdasarkan tabel dari perhitungan MOORA yang dapat dijadikan rekomendasi alternatif, maka didapatkan alternatif dengan nilai tertinggi yaitu: <span style="font-weight: bold;">{{ $topRanking->alternatif }}</span> dengan nilai <span style="font-weight: bold;">{{ round($topRanking->nilai, 3) }}</span></p>
                </div>
            </div>
        </div>
    </section>
@endsection
