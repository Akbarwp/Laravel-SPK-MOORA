@extends("dashboard.layouts.main")

@section("js")
    <script>
        let alternatif = [];
        let nilaiPreferensi = [];
        @foreach ($nilaiPreferensi as $item)
            alternatif.push(' {{ $item->alternatif->alternatif }} ');
            nilaiPreferensi.push(' {{ round($item->nilai, 3) }} ');
        @endforeach

        let chart_perankingan = {
            chart: {
                height: 300,
                type: "line",
                stacked: true
            },
            dataLabels: {
                enabled: false
            },
            series: [{
                data: nilaiPreferensi
            }, ],
            stroke: {
                curve: 'smooth',
                width: 4,
            },
            marker: {
                size: 10,
            },
            colors: ["#944535"],
            xaxis: {
                categories: alternatif,
                axisTicks: {
                    show: true
                },
                axisBorder: {
                    show: true,
                    color: "#BB7334"
                },
                labels: {
                    style: {
                        colors: "#BB7334"
                    }
                },
                title: {
                    text: "Alternatif",
                    style: {
                        color: "#944535"
                    }
                }
            },
            yaxis: [{
                axisTicks: {
                    show: true
                },
                axisBorder: {
                    show: true,
                    color: "#BB7334"
                },
                labels: {
                    style: {
                        colors: "#BB7334"
                    }
                },
                title: {
                    text: "Nilai",
                    style: {
                        color: "#944535"
                    }
                }
            }, ],
            tooltip: {
                enabled: true,
                shared: false,
                followCursor: false,
                x: {
                    show: false,
                },
                y: {
                    formatter: undefined,
                    title: {
                        formatter: (seriesName) => "",
                    },
                },
            },
        };

        var chart1 = new ApexCharts(document.querySelector("#chart-perankingan"), chart_perankingan);
        chart1.render();
    </script>
@endsection

@section("container")
    <div>
        <!-- row 1 -->
        <div class="-mx-3 mb-5 flex flex-wrap">
            <!-- Kriteria -->
            <div class="mb-6 w-full max-w-full px-3 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/3">
                <div class="relative flex min-w-0 flex-col break-words rounded-2xl bg-secondary-color bg-clip-border shadow-md dark:bg-primary-color-dark dark:shadow-primary-color-dark/20">
                    <div class="flex-auto p-4">
                        <div class="-mx-3 flex flex-row">
                            <div class="w-2/3 max-w-full flex-none px-3">
                                <div>
                                    <p class="mb-0 font-sans text-sm font-semibold uppercase leading-normal dark:text-secondary-color-dark">Kriteria</p>
                                    <h5 class="mb-2 font-bold text-primary-color-dark dark:text-white">{{ $kriteria }}</h5>
                                </div>
                            </div>
                            <div class="basis-1/3 px-3 text-right">
                                <div class="rounded-circle inline-block h-12 w-12 bg-gradient-to-tl from-primary-color to-secondary-color text-center dark:bg-gradient-to-tl dark:from-primary-color-dark dark:to-secondary-color-dark">
                                    <i class="ri-puzzle-line relative top-3 text-2xl leading-none text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sub Kriteria -->
            <div class="mb-6 w-full max-w-full px-3 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/3">
                <div class="relative flex min-w-0 flex-col break-words rounded-2xl bg-secondary-color bg-clip-border shadow-md dark:bg-primary-color-dark dark:shadow-primary-color-dark/20">
                    <div class="flex-auto p-4">
                        <div class="-mx-3 flex flex-row">
                            <div class="w-2/3 max-w-full flex-none px-3">
                                <div>
                                    <p class="mb-0 font-sans text-sm font-semibold uppercase leading-normal dark:text-secondary-color-dark">Sub Kriteria</p>
                                    <h5 class="mb-2 font-bold text-primary-color-dark dark:text-white">{{ $subKriteria }}</h5>
                                </div>
                            </div>
                            <div class="basis-1/3 px-3 text-right">
                                <div class="rounded-circle inline-block h-12 w-12 bg-gradient-to-tl from-primary-color to-secondary-color text-center dark:bg-gradient-to-tl dark:from-primary-color-dark dark:to-secondary-color-dark">
                                    <i class="ri-puzzle-2-fill relative top-3 text-2xl leading-none text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alternatif -->
            <div class="mb-6 w-full max-w-full px-3 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/3">
                <div class="relative flex min-w-0 flex-col break-words rounded-2xl bg-secondary-color bg-clip-border shadow-md dark:bg-primary-color-dark dark:shadow-primary-color-dark/20">
                    <div class="flex-auto p-4">
                        <div class="-mx-3 flex flex-row">
                            <div class="w-2/3 max-w-full flex-none px-3">
                                <div>
                                    <p class="mb-0 font-sans text-sm font-semibold uppercase leading-normal dark:text-secondary-color-dark">Alternatif</p>
                                    <h5 class="mb-2 font-bold text-primary-color-dark dark:text-white">{{ $alternatif }}</h5>
                                </div>
                            </div>
                            <div class="basis-1/3 px-3 text-right">
                                <div class="rounded-circle inline-block h-12 w-12 bg-gradient-to-tl from-primary-color to-secondary-color text-center dark:bg-gradient-to-tl dark:from-primary-color-dark dark:to-secondary-color-dark">
                                    <i class="ri-survey-line relative top-3 text-2xl leading-none text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- row 2 -->
        <div class="-mx-3 mb-5 flex flex-wrap">
            <!-- SPK -->
            <div class="mb-6 w-full max-w-full px-3 sm:w-1/2 sm:flex-none xl:mb-0">
                <div class="min-w-0 rounded-lg bg-white bg-clip-border p-4 shadow-md dark:shadow-spanish-white/20">
                    <h4 class="mb-4 font-semibold text-primary-color dark:text-primary-color-dark">
                        Sistem Pendukung Keputusan
                    </h4>
                    <p class="mb-3 text-justify text-primary-color-dark dark:text-primary-color">
                        MOORA diperkenalkan oleh Brauers dan Zavadkas dan pertama kali digunakan oleh Brauers
                        dalam suatu pengambilan keputusan dengan multi-kriteria. Metode ini memiliki tingkat fleksibilitas
                        yang tinggi dan kemudahan dalam memisahkan bagian subjektif dari suatu proses evaluasi
                        ke dalam kriteria bobot keputusan dengan beberapa atribut pengambilan keputusan.
                    </p>
                    <a class="group text-sm font-semibold leading-normal text-primary-color dark:text-primary-color-dark" href="#">
                        Mulai
                        <i class="ri-arrow-right-line ease-bounce group-hover:translate-x-1.25 ml-1 text-sm leading-normal transition-all duration-200"></i>
                    </a>
                </div>
            </div>

            <!-- Manfaat -->
            <div class="mb-6 w-full max-w-full px-3 sm:w-1/2 sm:flex-none xl:mb-0">
                <div class="min-w-0 rounded-lg bg-primary-color p-4 text-white shadow-md dark:bg-primary-color-dark dark:shadow-primary-color-dark/20">
                    <h4 class="mb-4 font-semibold text-secondary-color dark:text-secondary-color-dark">
                        Kegunaan MOORA (Multi Objective Optimizaton By Ratio Analysis):
                    </h4>
                    <ul style="list-style-type: square;" class="mx-5 mb-3 text-white dark:text-white">
                        <li>Memiliki tingkat fleksibilitas dan kemudahan untuk dipahami dalam memisahkan bagian subjektif dari suatu proses evaluasi kedalam kriteria bobot keputusan dengan beberapa atribut pengambilan keputusan.</li>
                        <li>Memiliki tingkat selektifitas yang baik karena dapat menentukan tujuan dari kriteria yang bertentangan yang mana kriteria dapat bernilai menguntungkan (benefit) atau yang tidak menguntungkan (cost).</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- row 4 -->
        <div class="-mx-3 mt-6 flex flex-wrap gap-y-2">
            <div class="mt-0 w-full max-w-full px-3 lg:flex-none">
                <div class="dark:shadow-akaroa/20 relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid border-primary-color/10 bg-white bg-clip-border shadow-xl">
                    <div class="mb-0 rounded-t-2xl border-b-0 border-solid border-primary-color/10 p-6 pb-0 pt-4">
                        <h6 class="font-semibold capitalize text-primary-color dark:text-primary-color-dark">Hasil Perhitungan SMART</h6>
                    </div>
                    <div class="flex-auto p-4">
                        <div id="chart-perankingan"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
