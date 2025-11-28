<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Llista extends Model
{
    use HasFactory;

    // Agregamos 'comprat' a fillable
    protected $fillable = [
        'titol',
        'descripcio',
        'categoria_id',
        'user_id',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function productes()
    {
        return $this->hasMany(Producte::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

