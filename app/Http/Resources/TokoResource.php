<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TokoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);

        // return[
        //     'id' => $this->id_toko,
        //     'nama_toko' => $this->nama_toko,
        //     'alamat_toko' => $this->alamat_toko,

        // ];
    }
}
