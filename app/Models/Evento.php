<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;
    protected $fillable =['gestion_id','nombre','descripcion','documento','inicio','fin','cabeza','pie','estado'];

    public function gestion()
    {
        return $this->belongsTo(Gestion::class, 'gestion_id');
    }
    public function Tematicas()
    {
        return $this->belongsToMany(Tematica::class, 'eventos_tematicas');
    }
}
