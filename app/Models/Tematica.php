<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tematica extends Model
{
    use HasFactory;
    protected $fillable =['nombre','descripcion','documento','cabeza','estado'];

    public function Eventos()
    {
        return $this->belongsToMany(Evento::class, 'eventos_tematicas');
    }
}
