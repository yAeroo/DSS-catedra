<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void{
        User::create([
            'name' => 'admin',
            'password' => bcrypt('admin'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'user',
            'password' => bcrypt('user'),
            'role' => 'user'
        ]);

        $this->call([
            TipoEmpresaSeeder::class,
            EmpresaSeeder::class,
            ConvenioSeeder::class,
            EvidenciaSeeder::class
        ]);
    }
}
