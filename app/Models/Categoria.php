<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    // Forzar a usar la tabla 'categories'
    protected $table = 'categories';

    protected $fillable = ['nom', 'user_id'];

    public function usuari()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function productes()
    {
        return $this->hasMany(Producte::class, 'categoria_id');
    }
}