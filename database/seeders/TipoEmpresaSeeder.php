<?php

namespace Database\Seeders;

use App\Models\TipoEmpresa;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TipoEmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void{
            TipoEmpresa::create([
                'nombre' => 'Organismos Multilaterales',
                'descripcion' => 'Instituciones sin ánimo de lucro cuyo capital social está constituido por las aportaciones de diversos gobiernos',
            ]);

            TipoEmpresa::create([
                'nombre' => 'Organismos Bilaterales',
                'descripcion' => 'Aquella en la que participan dos países o las instituciones de dos países.',
            ]);

            TipoEmpresa::create([
                'nombre' => 'Instituciones Gubernamentales',
                'descripcion' => 'Instituciones creadas con la finalidad de prestar un servicio público, son consideradas entidades
                gubernamentales que cuentan con un régimen jurídico, patrimonio y características propias.',
            ]);
    }
}
