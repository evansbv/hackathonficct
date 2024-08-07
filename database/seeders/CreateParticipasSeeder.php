<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Participa;

class CreateParticipasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Participa::create([
            'equipo_id' => 1,
            'evento_id' => 2,
            'tematica_id' => 1,
            'fecha' => date('Y-m-d H:i'),
            'descripcion' => 'Inscripcion 2da Version HACKATHON 2022'
        ]);
    }
}
