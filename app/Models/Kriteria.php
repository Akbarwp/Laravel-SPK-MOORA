<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    /** @use HasFactory<\Database\Factories\KriteriaFactory> */
    use HasFactory;

    protected $table = 'kriteria';
    protected $fillable = [
        'kode',
        'kriteria',
        'bobot',
        'jenis_kriteria',
    ];

    public function subKriteria()
    {
        return $this->hasMany(SubKriteria::class, "kriteria_id");
    }

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, "kriteria_id");
    }

    public function normalisasiBobot()
    {
        return $this->hasMany(NormalisasiBobot::class, "kriteria_id");
    }

    public function matriksKeputusan()
    {
        return $this->hasMany(MatriksKeputusan::class, "kriteria_id");
    }

    public function nilaiPreferensi()
    {
        return $this->hasMany(NilaiPreferensi::class, "kriteria_id");
    }
}
