<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NilaiPreferensiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'alternatif' => new AlternatifResource($this->alternatif_id),
            'kriteria' => new KriteriaResource($this->kriteria_id),
            'nilai' => $this->nilai,
        ];
    }
}
