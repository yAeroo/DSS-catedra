<?php

namespace Database\Seeders;

use App\Models\ArchivoEvidencia as Evidencia;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EvidenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        Evidencia::create([
            'convenio_id' => 1,
            'nombre_archivo' => 'AACID_5_19_2025_01_16_51.pdf',
        ]);
    }
}
