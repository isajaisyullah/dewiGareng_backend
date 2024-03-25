<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    protected $table = 'paket_wisata';
    protected $fillable = ['name', 'price', 'picture', 'description'];

    public function wisata()
    {
        return $this->belongsToMany(Wisata::class, 'detail_paket', 'paket_wisata_id', 'wisata_id');
    }
}
