<?php

namespace App\Models;

use App\Models\Equipo;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\Persona;




class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function isAdmin(){
        return $this->rol=='Admin';
    }
    public function isEquipo(){
        return $this->rol=='Equipo';
    }
    public function isMentor(){
        return $this->rol=='Mentor';
    }
    public function isJurado(){
        return $this->rol=='Jurado';
    }
    public function equipo()
    {
        return $this->hasOne(Equipo::class);
    }
    public function personas()
    {
        return $this->hasMany(Persona::class, 'user_id');
    }
}
