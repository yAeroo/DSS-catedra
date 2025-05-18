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
            'nombre_archivo' => 'BID_04-05-2024_18_05_05.xlsx',
        ]);
    }
}
