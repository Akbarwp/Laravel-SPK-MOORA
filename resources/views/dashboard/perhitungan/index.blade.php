@extends("dashboard.layouts.main")

@section("js")
    <script>
        $(document).ready(function() {
            $('#myTable1').DataTable({
                responsive: {
                    details: {
                        type: 'column',
                        target: 'tr',
                    },
                },
                order: [],
                pagingType: 'full_numbers',
            });

            $('#myTable2').DataTable({
                responsive: {
                    details: {
                        type: 'column',
                        target: 'tr',
                    },
                },
                order: [],
                pagingType: 'full_numbers',
            });

            $('#myTable3').DataTable({
                responsive: {
                    details: {
                        type: 'column',
                        target: 'tr',
                    },
                },
                order: [],
                pagingType: 'full_numbers',
            });
        });

        function perhitungan_button() {
            Swal.fire({
                title: 'Perhitungan Metode MOORA',
                text: "Menghitung normalisasi bobot kriteria, Matriks Keputusan dan nilai Preferensi",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#6419E6',
                cancelButtonColor: '#F87272',
                confirmButtonText: 'Hitung',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        url: "{{ route("perhitungan.moora") }}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'Perhitungan berhasil dilakukan!',
                                icon: 'success',
                                confirmButtonColor: '#6419E6',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            });
                        },
                        error: function(response) {
                            Swal.fire({
                                title: 'Perhitungan gagal dilakukan!',
                                icon: 'error',
                                confirmButtonColor: '#6419E6',
                                confirmButtonText: 'OK'
                            });
                        }
                    });
                }
            })
        }
    </script>
@endsection

@section("container")
    <div class="-mx-3 flex flex-wrap">
        <div class="w-full max-w-full flex-none px-3">
            <div role="alert" class="alert mb-5 flex items-center justify-between border-0 bg-peach-yellow shadow-xl dark:bg-reno-sand dark:shadow-reno-sand/20">
                <h6 class="font-bold text-reno-sand dark:text-white">Tabel-Tabel {{ $title }}</h6>
                <div>
                    <button class="mb-0 inline-block cursor-pointer rounded-lg border border-solid border-success bg-white px-4 py-1 text-center align-middle text-sm font-bold leading-normal tracking-tight text-success shadow-none transition-all ease-in hover:-translate-y-px hover:opacity-75 active:opacity-90 md:px-8 md:py-2" onclick="return perhitungan_button()">
                        <i class="ri-add-fill"></i>
                        Perhitungan Metode MOORA
                    </button>
                </div>
            </div>

            {{-- Awal Tabel Normalisasi Bobot Kriteria --}}
            <div class="relative mb-6 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid border-transparent bg-white bg-clip-border shadow-xl dark:bg-white dark:shadow-peach-yellow/20">
                <div class="border-b-solid mb-0 flex items-center justify-between rounded-t-2xl border-b-0 border-b-transparent p-6 pb-3">
                    <h6 class="font-bold text-reno-sand dark:text-el-salva">Tabel Normalisasi Bobot Kriteria</h6>
                </div>
                <div class="flex-auto px-0 pb-2 pt-0">
                    <div class="overflow-x-auto p-0 px-6 pb-6">
                        <table id="myTable1" class="nowrap stripe mb-3 w-full max-w-full border-collapse items-center align-top" style="width: 100%;">
                            <thead class="align-bottom">
                                <tr class="bg-reno-sand text-xs font-bold uppercase text-white dark:bg-el-salva dark:text-white">
                                    <th class="rounded-tl">
                                        Kode
                                    </th>
                                    <th>
                                        Nama Kriteria
                                    </th>
                                    <th>
                                        Bobot
                                    </th>
                                    <th class="rounded-tr">
                                        Normalisasi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($normalisasiBobot as $item)
                                    <tr class="border-b border-reno-sand bg-transparent dark:border-el-salva">
                                        <td>
                                            <p class="text-center align-middle text-base font-semibold leading-tight text-reno-sand dark:text-el-salva">
                                                {{ $item->kriteria->kode }}
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-left align-middle text-base font-semibold leading-tight text-reno-sand dark:text-el-salva">
                                                {{ $item->kriteria->kriteria }}
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-center align-middle text-base font-semibold leading-tight text-reno-sand dark:text-el-salva">
                                                {{ $item->kriteria->bobot }}
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-center align-middle text-base font-semibold leading-tight text-reno-sand dark:text-el-salva">
                                                {{ round($item->normalisasi, 3) }}
                                            </p>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tr>
                                <td></td>
                                <td class="text-right align-middle text-base font-semibold leading-tight text-reno-sand dark:text-el-salva">Total:</td>
                                <td class="text-center align-middle text-base font-bold leading-tight text-reno-sand dark:text-el-salva">
                                    @if ($normalisasiBobot->first())
                                        {{ $sumBobotKriteria }}
                                    @else
                                        0
                                    @endif
                                </td>
                                <td class="text-center align-middle text-base font-bold leading-tight text-reno-sand dark:text-el-salva">
                                    {{ $normalisasiBobot->sum("normalisasi") }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            {{-- Akhir Tabel Normalisasi Bobot Kriteria --}}

            {{-- Awal Tabel Matriks Keputusan --}}
            <div class="relative mb-6 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid border-transparent bg-white bg-clip-border shadow-xl dark:bg-white dark:shadow-peach-yellow/20">
                <div class="border-b-solid mb-0 flex items-center justify-between rounded-t-2xl border-b-0 border-b-transparent p-6 pb-3">
                    <h6 class="font-bold text-reno-sand dark:text-el-salva">Tabel Matriks Keputusan</h6>
                </div>
                <div class="flex-auto px-0 pb-2 pt-0">
                    <div class="overflow-x-auto p-0 px-6 pb-6">
                        <table id="myTable2" class="nowrap stripe mb-3 w-full max-w-full border-collapse items-center align-top" style="width: 100%;">
                            <thead class="align-bottom">
                                <tr class="bg-reno-sand text-xs font-bold uppercase text-white dark:bg-el-salva dark:text-white">
                                    <th class="rounded-tl"></th>
                                    @foreach ($kriteria as $item)
                                        <th>
                                            {{ $item->kriteria }}
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($alternatif as $item)
                                    <tr class="border-b border-reno-sand bg-transparent dark:border-el-salva">
                                        <td>
                                            <p class="text-left align-middle text-base font-semibold leading-tight text-reno-sand dark:text-el-salva">
                                                {{ $item->alternatif }}
                                            </p>
                                        </td>
                                        @if ($matriksKeputusan->first())
                                            @foreach ($matriksKeputusan->where("alternatif_id", $item->id) as $value)
                                                <td>
                                                    <p class="text-center align-middle text-base font-semibold leading-tight text-reno-sand dark:text-el-salva">
                                                        @if ($value->nilai == 0)
                                                            {{ round($value->nilai, 3) }}
                                                        @elseif ($value->nilai == null)
                                                            -
                                                        @else
                                                            {{ round($value->nilai, 3) }}
                                                        @endif
                                                    </p>
                                                </td>
                                            @endforeach
                                        @else
                                            @foreach ($kriteria as $item)
                                                <td>
                                                    <p class="text-center align-middle text-base font-semibold leading-tight text-reno-sand dark:text-el-salva">
                                                        -
                                                    </p>
                                                </td>
                                            @endforeach
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="w-fit overflow-x-auto">
                            <table class="table table-xs">
                                <tr>
                                    <td class="text-base font-semibold text-reno-sand dark:text-el-salva">Keterangan:</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="text-base text-reno-sand dark:text-el-salva">* Pastikan setiap alternatif terisi semua pada menu penilaian</td>
                                    <td class="text-base text-reno-sand dark:text-el-salva"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Akhir Tabel Matriks Keputusan --}}

            {{-- Awal Tabel Nilai Preferensi --}}
            <div class="relative mb-6 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid border-transparent bg-white bg-clip-border shadow-xl dark:bg-white dark:shadow-peach-yellow/20">
                <div class="border-b-solid mb-0 flex items-center justify-between rounded-t-2xl border-b-0 border-b-transparent p-6 pb-3">
                    <h6 class="font-bold text-reno-sand dark:text-el-salva">Tabel Nilai Preferensi</h6>
                </div>
                <div class="flex-auto px-0 pb-2 pt-0">
                    <div class="overflow-x-auto p-0 px-6 pb-6">
                        <table id="myTable3" class="nowrap stripe mb-3 w-full max-w-full border-collapse items-center align-top" style="width: 100%;">
                            <thead class="align-bottom">
                                <tr class="bg-reno-sand text-xs font-bold uppercase text-white dark:bg-el-salva dark:text-white">
                                    <th class="rounded-tl"></th>
                                    @foreach ($kriteria as $item)
                                        <th>
                                            {{ $item->kriteria }}
                                        </th>
                                    @endforeach
                                    <th class="rounded-tr">
                                        Total
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($alternatif as $item)
                                    <tr class="border-b border-reno-sand bg-transparent dark:border-el-salva">
                                        <td>
                                            <p class="text-left align-middle text-base font-semibold leading-tight text-reno-sand dark:text-el-salva">
                                                {{ $item->alternatif }}
                                            </p>
                                        </td>
                                        @if ($nilaiPreferensi->first())
                                            @foreach ($nilaiPreferensi->where("alternatif_id", $item->id) as $value)
                                                <td>
                                                    <p class="text-center align-middle text-base font-semibold leading-tight text-reno-sand dark:text-el-salva">
                                                        @if ($value->nilai == 0)
                                                            {{ round($value->nilai, 3) }}
                                                        @elseif ($value->nilai == null)
                                                            -
                                                        @else
                                                            {{ round($value->nilai, 3) }}
                                                        @endif
                                                    </p>
                                                </td>
                                            @endforeach
                                            <td>
                                                <p class="text-center align-middle text-base font-bold leading-tight text-reno-sand dark:text-el-salva">
                                                    {{ round($nilaiPreferensi->where("alternatif_id", $item->id)->sum("nilai"), 3) }}
                                                </p>
                                            </td>
                                        @else
                                            @foreach ($kriteria as $item)
                                                <td>
                                                    <p class="text-center align-middle text-base font-semibold leading-tight text-reno-sand dark:text-el-salva">
                                                        -
                                                    </p>
                                                </td>
                                            @endforeach
                                            <td>
                                                <p class="text-center align-middle text-base font-semibold leading-tight text-reno-sand dark:text-el-salva">
                                                    -
                                                </p>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="w-fit overflow-x-auto">
                            <table class="table table-xs">
                                <tr>
                                    <td class="text-base font-semibold text-reno-sand dark:text-el-salva">Keterangan:</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="text-base text-reno-sand dark:text-el-salva">* Pastikan setiap alternatif terisi semua pada menu penilaian</td>
                                    <td class="text-base text-reno-sand dark:text-el-salva"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Akhir Tabel Nilai Preferensi --}}
        </div>
    </div>
@endsection
