<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use App\Models\SubKriteria;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubKriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kriteria = Kriteria::orderBy('id', 'asc')->get();
        $subKriteria = ['Sangat Baik', 'Baik', 'Cukup', 'Buruk', 'Sangat Buruk'];
        $subKriteriaPrice = ['Sangat Murah', 'Murah', 'Cukup', 'Mahal', 'Sangat Mahal'];
        foreach ($kriteria as $item) {
            if ($item->jenis_kriteria == 'cost') {
                SubKriteria::factory()->create([
                    'sub_kriteria' => $subKriteriaPrice[0],
                    'bobot' => 1,
                    'kriteria_id' => $item->id,
                ]);
                SubKriteria::factory()->create([
                    'sub_kriteria' => $subKriteriaPrice[1],
                    'bobot' => 2,
                    'kriteria_id' => $item->id,
                ]);
                SubKriteria::factory()->create([
                    'sub_kriteria' => $subKriteriaPrice[2],
                    'bobot' => 3,
                    'kriteria_id' => $item->id,
                ]);
                SubKriteria::factory()->create([
                    'sub_kriteria' => $subKriteriaPrice[3],
                    'bobot' => 4,
                    'kriteria_id' => $item->id,
                ]);
                SubKriteria::factory()->create([
                    'sub_kriteria' => $subKriteriaPrice[4],
                    'bobot' => 5,
                    'kriteria_id' => $item->id,
                ]);
            } else if ($item->jenis_kriteria == 'benefit') {
                SubKriteria::factory()->create([
                    'sub_kriteria' => $subKriteria[0],
                    'bobot' => 5,
                    'kriteria_id' => $item->id,
                ]);
                SubKriteria::factory()->create([
                    'sub_kriteria' => $subKriteria[1],
                    'bobot' => 4,
                    'kriteria_id' => $item->id,
                ]);
                SubKriteria::factory()->create([
                    'sub_kriteria' => $subKriteria[2],
                    'bobot' => 3,
                    'kriteria_id' => $item->id,
                ]);
                SubKriteria::factory()->create([
                    'sub_kriteria' => $subKriteria[3],
                    'bobot' => 2,
                    'kriteria_id' => $item->id,
                ]);
                SubKriteria::factory()->create([
                    'sub_kriteria' => $subKriteria[4],
                    'bobot' => 1,
                    'kriteria_id' => $item->id,
                ]);
            }
        }
    }
}
