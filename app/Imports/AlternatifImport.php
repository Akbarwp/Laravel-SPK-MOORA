<?php

namespace App\Imports;

use App\Models\Alternatif;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class AlternatifImport implements ToModel, WithStartRow, WithHeadingRow
{
    public function startRow(): int
    {
        return 2;
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function model(array $row)
    {
        $lastKode = Alternatif::orderBy('kode', 'desc')->first();
        if ($lastKode) {
            $kode = "A" . str_pad((int) substr($lastKode->kode, 1) + 1, 5, '0', STR_PAD_LEFT);
        } else {
            $kode = "A00001";
        }
        return new Alternatif([
            'kode' => $kode,
            'alternatif' => $row['alternatif'],
            'keterangan' => $row['keterangan'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
