<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NormalisasiBobot extends Model
{
    protected $table = 'normalisasi_bobot';
    protected $fillable = [
        'kriteria_id',
        'normalisasi',
    ];

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, "kriteria_id");
    }
}
