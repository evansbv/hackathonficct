<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Gestion;

class CreateGestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gestion::create([
            'nombre' => '2022',
            'descripcion' => 'Gestion Año 2022',
            'observacion' => 'Normal',
            'inicio' => '2022-01-01',
            'fin' => '2022-12-31',
            'estado' => 0
        ]);
    }
}
