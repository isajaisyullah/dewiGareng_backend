<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    protected $table = 'umkm';
    protected $fillable = ['name', 'address', 'logo', 'description', 'users_id'];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'umkm_id');
    }
}
