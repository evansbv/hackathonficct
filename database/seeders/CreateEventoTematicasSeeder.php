<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class CreateEventoTematicasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        DB::insert('insert into eventos_tematicas (evento_id,tematica_id) values (?, ?)', [2, 1]);
        DB::insert('insert into eventos_tematicas (evento_id,tematica_id) values (?, ?)', [2, 2]);
        DB::insert('insert into eventos_tematicas (evento_id,tematica_id) values (?, ?)', [2, 3]);
        */
        DB::insert('insert into eventos_tematicas (evento_id,tematica_id,created_at,updated_at) values (?, ?, ?, ?)', [2, 1,  \Carbon\Carbon::now(), \Carbon\Carbon::now()]);
        DB::insert('insert into eventos_tematicas (evento_id,tematica_id,created_at,updated_at) values (?, ?, ?, ?)', [2, 2,  \Carbon\Carbon::now(), \Carbon\Carbon::now()]);
        DB::insert('insert into eventos_tematicas (evento_id,tematica_id,created_at,updated_at) values (?, ?, ?, ?)', [2, 3,  \Carbon\Carbon::now(), \Carbon\Carbon::now()]);

    }
}
