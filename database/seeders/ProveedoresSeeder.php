<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProveedoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $proveedores = [
            ['id' => 1, 'nombre' => 'Sin Asignar']
        ];

        foreach ($proveedores as $proveedor) {
            DB::table('proveedores')->insert([
                'id' => $proveedor['id'],
                'nombre' => $proveedor['nombre'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
