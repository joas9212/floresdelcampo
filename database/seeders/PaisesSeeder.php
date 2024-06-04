<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PaisesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paises = [
            'Colombia'
        ];

        foreach ($paises as $pais) {
            DB::table('paises')->insert([
                'nombre' => $pais,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
