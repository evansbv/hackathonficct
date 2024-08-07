<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Persona;

class Persona extends Model
{
    use HasFactory;
    protected $fillable =['user_id','registro','carrera','ci','nombres','apellidos','nacimiento','direccion','email','celular','foto'];
    //protected $fillable =['registro','carrera','ci','nombres','apellidos','nacimiento','direccion','email','celular','foto'];

    public function user()
    {
        return $this->hasOne(User::class);
    }
    public function equipos()
    {
        return $this->belongsToMany(Equipo::class, 'equipos_personas');
    }
    public function participaciones()
    {
        return $this->belongsToMany(Participa::class);
    }
}
