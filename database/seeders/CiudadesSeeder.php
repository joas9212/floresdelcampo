<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CiudadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ciudades = [
            ['nombre' => 'Bogotá', 'pais_id' => 1],
            ['nombre' => 'Cali', 'pais_id' => 1]
        ];

        foreach ($ciudades as $ciudad) {
            DB::table('ciudades')->insert([
                'nombre' => $ciudad['nombre'],
                'pais_id' => $ciudad['pais_id'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
