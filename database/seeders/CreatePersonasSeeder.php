<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Persona;

class CreatePersonasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Persona::create([
            'user_id' => 1,
            'registro' => '1124390',
            'carrera' => '187-1',
            'ci' => '3924689-SCZ',
            'nombres' => 'Evans',
            'apellidos' => 'Balcazar Veizaga',
            'nacimiento' => '1975-08-29',
            'direccion' => 'Ac. Alemana 9no Anillo',
            'email' => 'evansbv@gmail.com',
            'celular' => '72107856',
            'foto' => 'evans.jpg'
        ]);
        Persona::create([
            'user_id' => 1,
            'registro' => '1123023',
            'carrera' => '187-1',
            'ci' => '3885821-SCZ',
            'nombres' => 'Erwin Erick',
            'apellidos' => 'Ureña Inarra',
            'nacimiento' => '1976-01-24',
            'direccion' => 'Ac. Santos Dumont 5to Anillo',
            'email' => 'ericksapiens@gmail.com',
            'celular' => '77382601',
            'foto' => 'erick.jpg'
        ]);
        Persona::create([
            'user_id' => 1,
            'registro' => '1120320',
            'carrera' => '187-1',
            'ci' => '4012065-SCZ',
            'nombres' => 'Jose Manuel',
            'apellidos' => 'Colque Paulsanz',
            'nacimiento' => '1975-06-14',
            'direccion' => 'Radial #13 4to Anillo',
            'email' => 'josemanuelcp@gmail.com',
            'celular' => '72150979',
            'foto' => 'josemanuel.jpg'
        ]);
    }
}
