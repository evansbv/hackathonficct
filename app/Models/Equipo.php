<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;
    protected $fillable =['user_id','sigla','nombre','descripcion','cantidad'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function personas()
    {
        //return $this->belongsToMany(Persona::class, 'equipos_personas');
    }
    public function participaciones()
    {
        return $this->hasMany(Participa::class, 'equipo_id');
    }
}
