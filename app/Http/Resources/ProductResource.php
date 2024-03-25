<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'picture' => $this->picture,
            'description' => $this->description,
            // 'category_id' => $this->category_id,
            'categories' => [
                'id' => $this->category->id,
                'category' => $this->category->name,
            ],
            'umkm' => new UmkmResource($this->whenLoaded('umkm')), //eager load(with)
            // 'umkm' => new UmkmResource($this->umkm),

            // 'umkm_id' => $this->umkm_id,

            // 'umkm' => [
            //     'id' => $this->umkm->id,
            //     'store' => $this->umkm->name,
            // ],


        ];
    }
}
