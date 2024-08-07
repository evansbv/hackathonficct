<?php

namespace App\Exports;

use App\Models\Participa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use App\Models\Evento;
use App\Models\Tematica;
use App\Models\Equipo;
use App\Models\Persona;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ParticipasExport implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        return [
            //'Evento',
            //'Tematica',
            'Codigo Participacion',
            'Fecha',
            'Sigla Equipo',
            'Nombre Equipo',
            'Nombre Proyecto',
            'Estado Inscripcion',
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $participas = DB::table('participas')->orderBy('participas.id','desc')
        //->where('participas.equipo_id','equipos.id')
        ->join('equipos', 'participas.equipo_id', '=', 'equipos.id')
        ->join('eventos', 'participas.evento_id', '=', 'eventos.id')
        ->join('tematicas', 'participas.tematica_id', '=', 'tematicas.id')
        //->select('eventos.nombre as Evento', 'tematicas.nombre as Tematica', 'participas.id as Inscripcion', 'participas.fecha as Fecha',
        //    'equipos.sigla as Sigla Equipo','equipos.nombre as Nombre Equipo',
        //    'participas.descripcion as Nombre Proyecto' , 'participas.estado as Estado Inscripcion')
        ->select('participas.id as Inscripcion', 'participas.fecha as Fecha',
            'equipos.sigla as Sigla Equipo','equipos.nombre as Nombre Equipo',
            'participas.descripcion as Nombre Proyecto' , 'participas.estado as Estado Inscripcion')
            ->where('eventos.estado', '=', 0)
        ->get();
        //dd($participas->first());
        return $participas;
        //return Participa::all();
    }
}
