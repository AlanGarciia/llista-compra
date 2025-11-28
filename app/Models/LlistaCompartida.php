<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LlistaCompartida extends Model
{
    use HasFactory;

    protected $table = 'llistas_compartidas';
    protected $fillable = ['remitente_id', 'receptor_id', 'llista_original_id'];

    public function llistaOriginal()
    {
        return $this->belongsTo(Llista::class, 'llista_original_id');
    }

    public function remitente()
    {
        return $this->belongsTo(User::class, 'remitente_id');
    }

    public function receptor()
    {
        return $this->belongsTo(User::class, 'receptor_id');
    }
}
