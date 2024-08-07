<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Evento;


class CreateEventosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Evento::create([
            'gestion_id' => 1,
            'nombre' => 'Feria de Ciencia 1-2002',
            'descripcion' => '“Feria de Ciencias Facultativas”',
            'documento' => 'feria_1-2022.pdf',
            'inicio' => '2022-06-01',
            'fin' => '2022-06-30',
            'cabeza' => 'cabeza.jpg',
            'pie' => 'pie.jpg',
            'estado' => 1
        ]);
        Evento::create([
            'gestion_id' => 1,
            'nombre' => '2DA VERSION HACKATHON-FICCT 2002',
            'descripcion' => '“Santa Cruz 4.0”',
            'documento' => 'hackathon-2022.pdf',
            'inicio' => '2022-10-01',
            'fin' => '2022-12-03',
            'cabeza' => 'cabeza1.jpg',
            'pie' => 'pie1.jpg',
            'estado' => 0
        ]);
    }
}
