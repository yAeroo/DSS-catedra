<?php

namespace Database\Seeders;

use App\Models\Empresa;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        Empresa::create([
            'abreviatura_empresa' => 'BID',
            'nombre_empresa' => 'Banco Interamericano de Desarrollo',
            'codigo_donante' => 'MULT-BID-2024',
            'tipo_cooperacion' => 'Multilateral',
            'tipo_relacion' => 'Proyecto',
            'direccion' => 'San Salvador, El Salvador',
            'estado' => 'Activo',
            'tipo_empresa_id' => 1,
        ]);

        Empresa::create([
            'abreviatura_empresa' => 'UNICEF',
            'nombre_empresa' => 'Fondo de las Naciones Unidas para la Infancia',
            'codigo_donante' => 'MULT-UNICEF-2024',
            'tipo_cooperacion' => 'Multilateral',
            'tipo_relacion' => 'Proyecto',
            'direccion' => 'San Salvador, El Salvador',
            'estado' => 'Activo',
            'tipo_empresa_id' => 1,
        ]);

        Empresa::create([
            'abreviatura_empresa' => 'AACID',
            'nombre_empresa' => 'Agencia Andaluza de Cooperación Internacional para el Desarrollo',
            'codigo_donante' => 'BIL-AACID-2024',
            'tipo_cooperacion' => 'Bilateral',
            'tipo_relacion' => 'Proyecto',
            'direccion' => 'Sevilla, España',
            'estado' => 'Activo',
            'tipo_empresa_id' => 2,
        ]);
    }
}
