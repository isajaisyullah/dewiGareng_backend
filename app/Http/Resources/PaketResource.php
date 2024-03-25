<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\WisataResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PaketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'price'       => $this->price,
            'picture'     => $this->picture,
            'description' => $this->description,
            'listWisata' => WisataResource::collection($this->whenLoaded('wisata')),
        ];
    }
}
