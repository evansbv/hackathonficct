<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Tematica;

class CreateTematicasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tematica::create([
            'nombre' => '1.- Integración de los sistemas de información',
            'descripcion' => '            ▪ Aplicaciones para Alerta Temprana (Zonas de Riesgos, Monitorio de Semáforo y Luminarias, Ciudad Limpia)
            ▪ Aplicaciones para Agropecuaria (Gestión Agrícola, Gestión Pecuaria)
            ▪ Aplicaciones para Gestión (Herramientas para Desarrollo y Gestión de Workflow, Bolsa de Trabajos-Proyectos)
            ▪ Integridad de documentos digitales',
            'documento' => 'tema1.pdf',
            'cabeza' => 'cabeza21.jpg',
            'estado' => 0
        ]);
        Tematica::create([
            'nombre' => '2.- Cloud',
            'descripcion' => '    • Aplicaciones para Transporte (Transporte Metropolitano)
    • Aplicaciones para Geo-referenciacion de Oficinas Publica y/o Privadas (Zonas de Riesgos, Monitorio de Semáforo y Luminarias, Ciudad Limpia)
    • Aplicaciones para Teletrabajo',
            'documento' => 'tema2.pdf',
            'cabeza' => 'cabeza22.jpg',
            'estado' => 0
        ]);
        Tematica::create([
            'nombre' => '3.- Realidad aumentada',
            'descripcion' => '            ▪ Aplicaciones para Turismo (Servicio de Turismo Virtual)
            ▪ Aplicaciones para Historia (Museo de Historia Virtual)	',
            'documento' => 'tema3.pdf',
            'cabeza' => 'cabeza23.jpg',
            'estado' => 0
        ]);
    }
}
