<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\Alternatif;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PenilaianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $alternatif = Alternatif::orderBy('id', 'asc')->get();
        $kriteria = Kriteria::orderBy('id', 'asc')->get();
        $subKriteria = [
            [
                'alternatif_id' => 1,
                'sub_kriteria_id' => [4, 9, 14, 19],
            ],
            [
                'alternatif_id' => 2,
                'sub_kriteria_id' => [4, 9, 13, 18],
            ],
            [
                'alternatif_id' => 3,
                'sub_kriteria_id' => [4, 9, 14, 18],
            ],
            [
                'alternatif_id' => 4,
                'sub_kriteria_id' => [5, 10, 15, 20],
            ],
            [
                'alternatif_id' => 5,
                'sub_kriteria_id' => [4, 9, 15, 19],
            ],
            [
                'alternatif_id' => 6,
                'sub_kriteria_id' => [5, 10, 14, 18],
            ],
            [
                'alternatif_id' => 7,
                'sub_kriteria_id' => [5, 9, 15, 20],
            ],
            [
                'alternatif_id' => 8,
                'sub_kriteria_id' => [4, 10, 13, 19],
            ],
        ];
        foreach ($alternatif as $alt => $item) {
            foreach ($kriteria as $kri => $value) {
                Penilaian::create([
                    'alternatif_id' => $item->id,
                    'kriteria_id' => $value->id,
                    'sub_kriteria_id' => $subKriteria[$alt]['sub_kriteria_id'][$kri],
                ]);
            }
        }
    }
}
