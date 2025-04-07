<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kriteria::factory()->create([
            'kode' => 'K00001',
            'kriteria' => 'Visual',
            'bobot' => 30,
            'jenis_kriteria' => 'benefit',
        ]);
        Kriteria::factory()->create([
            'kode' => 'K00002',
            'kriteria' => 'Audio',
            'bobot' => 30,
            'jenis_kriteria' => 'benefit',
        ]);
        Kriteria::factory()->create([
            'kode' => 'K00003',
            'kriteria' => 'Story',
            'bobot' => 20,
            'jenis_kriteria' => 'benefit',
        ]);
        Kriteria::factory()->create([
            'kode' => 'K00004',
            'kriteria' => 'Price',
            'bobot' => 20,
            'jenis_kriteria' => 'cost',
        ]);
    }
}
