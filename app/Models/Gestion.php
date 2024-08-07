<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gestion extends Model
{
    use HasFactory;
    protected $fillable =['nombre','descripcion','observacion','inicio','fin','estado'];

    public function eventos()
    {
        return $this->hasMany(Evento::class, 'gestion_id');
    }
}
