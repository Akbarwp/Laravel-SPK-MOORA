<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    /** @use HasFactory<\Database\Factories\AlternatifFactory> */
    use HasFactory;

    protected $table = 'alternatif';
    protected $fillable = [
        'kode',
        'alternatif',
        'keterangan',
    ];

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, "alternatif_id");
    }

    public function matriksKeputusan()
    {
        return $this->hasMany(MatriksKeputusan::class, "alternatif_id");
    }

    public function nilaiPreferensi()
    {
        return $this->hasMany(NilaiPreferensi::class, "alternatif_id");
    }
}
