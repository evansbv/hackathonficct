<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Equipo;

class CreateEquiposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Equipo::create([
            'user_id' => 1,
            'sigla' => 'NT-2022',
            'nombre' => 'NITRO PROGRAMADORES 2022',
            'descripcion' => 'EXPERTOS EN ANDORID, ACM',
            'cantidad' => '3'
        ]);
    }
}
