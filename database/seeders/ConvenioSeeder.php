<?php

namespace Database\Seeders;

use App\Models\Convenio;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ConvenioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        Convenio::create([
            'empresa_id' => 1,
            'sede' => 'San Miguel',
            'nombre_contacto' => 'Guillermo López',
            'telefono_contacto' => 77774367,
            'correo_contacto' => 'bid@correo.com',
            'estado' => 'activo',
            'fecha_inicio' => '2024-04-02',
            'fecha_fin' => null,
            'tipo_convenio' => 'Donaciones',
            'convenio_detalle' => 'Convenio de cooperación financiera no reembolsable para el fortalecimiento institucional de programas sociales.',
            'convenio_respaldado' => 1,
            'habilitado' => 1,
            'estado_evidencia' => 1,
        ]);

        Convenio::create([
            'empresa_id' => 3,
            'sede' => 'Santa Ana',
            'nombre_contacto' => 'Nicolas Vilvo',
            'telefono_contacto' => 82278277,
            'correo_contacto' => 'aacid@correo.com',
            'estado' => 'finalizado',
            'fecha_inicio' => '2024-04-01',
            'fecha_fin' => '2024-04-04',
            'tipo_convenio' => 'Consulta',
            'convenio_detalle' => 'Convenio técnico para la elaboración de diagnósticos y recomendaciones sobre políticas de salud pública municipal.',
            'convenio_respaldado' => 0,
            'habilitado' => 1,
            'estado_evidencia' => 0,
        ]);

        Convenio::create([
            'empresa_id' => 3,
            'sede' => 'San Miguel',
            'nombre_contacto' => 'Camila',
            'telefono_contacto' => 12345678,
            'correo_contacto' => 'aacid@correo.com',
            'estado' => 'activo',
            'fecha_inicio' => '2024-04-10',
            'fecha_fin' => null,
            'tipo_convenio' => 'Proyecto',
            'convenio_detalle' => 'Convenio para la ejecución conjunta de proyectos de desarrollo sostenible enfocados en educación y medio ambiente.',
            'convenio_respaldado' => 0,
            'habilitado' => 1,
            'estado_evidencia' => 0,
        ]);
    }
}
