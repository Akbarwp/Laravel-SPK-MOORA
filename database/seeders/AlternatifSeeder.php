<?php

namespace Database\Seeders;

use App\Models\Alternatif;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AlternatifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Alternatif::factory()->create([
            'kode' => 'A00001',
        ]);
        Alternatif::factory()->create([
            'kode' => 'A00002',
        ]);
        Alternatif::factory()->create([
            'kode' => 'A00003',
        ]);
        Alternatif::factory()->create([
            'kode' => 'A00004',
        ]);
    }
}
