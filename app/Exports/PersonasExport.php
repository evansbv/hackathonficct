<?php

namespace App\Exports;

use App\Models\Persona;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use App\Models\Evento;
use App\Models\Tematica;
use App\Models\Equipo;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PersonasExport implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        return [
            'id',
            'user_prop',
            'Registro',
            'Carrera',
            'C.I.',
            'Nombres',
            'Apellidos',
            'Nacimiento',
            'Direccion',
            'Correo',
            'Celular',
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $personas = DB::table('personas')->orderBy('personas.id','asc')
        /*->where('participas.equipo_id','equipos.id')
        ->join('equipos', 'participas.equipo_id', '=', 'equipos.id')
        ->join('eventos', 'participas.evento_id', '=', 'eventos.id')
        ->join('tematicas', 'participas.tematica_id', '=', 'tematicas.id')
        ->select('eventos.nombre as Nombre Evento', 'participas.id as Nro. Inscripcion', 'participas.fecha as Fecha Inscripcion',
            'equipos.sigla as Sigla Equipo','equipos.nombre as Nombre Equipo',
            'participas.descripcion as Nombre Proyecto' , 'participas.estado as Estado Inscripcion')*/
        ->get();
        //dd($participas->first());
        return $personas;
        //return Participa::all();
    }
}
