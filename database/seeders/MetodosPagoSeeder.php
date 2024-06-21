<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetodosPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $metodosPago = [
            ['nombre' => 'Bancolombia'],
            ['nombre' => 'Daviplata'],
            ['nombre' => 'Nequi'],
            ['nombre' => 'ContraEntrega'],
            ['nombre' => 'Efectivo en la floristeria'],
            ['nombre' => 'Gana Gaga o Efecty'],
            ['nombre' => 'Pago virtual con link (PayU, Bold)'],
            ['nombre' => 'Transferencia Internacional (Western Union, Bancaria)'],
            ['nombre' => 'Criptomonedas']
        ];

        foreach ($metodosPago as $metodoPago) {
            DB::table('metodos_pago')->insert([
                'nombre' => $metodoPago['nombre'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
