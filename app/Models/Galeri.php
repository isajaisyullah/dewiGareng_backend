<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $table = 'galeri';
    protected $fillable = ['title', 'picture', 'description', 'users_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
