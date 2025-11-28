<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producte extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom', 
        'quantitat', 
        'comprat', 
        'llista_id',
        'categoria_id'
    ];

    public function llista()
    {
        return $this->belongsTo(Llista::class, 'llista_id');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
}
