<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Builder;

class Participa extends Model
{
    use HasFactory;
    //public $incrementing = false;
    //protected $primaryKey = ['equipo_id','evento_id','tematica_id'];
    //public $timestamps = false;
    protected $fillable =['equipo_id','evento_id','tematica_id','fecha','descripcion','estado','user_id'];

    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }
    public function tematica()
    {
        return $this->belongsTo(Tematica::class);
    }
    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }
}
