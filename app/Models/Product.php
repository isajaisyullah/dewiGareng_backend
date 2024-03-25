<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';
    protected $fillable = [
        'name',
        'price',
        'picture',
        'description',
        'stock',
        'category_id',
        'umkm_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function umkm()
    {
        return $this->belongsTo(Umkm::class);
    }
}
