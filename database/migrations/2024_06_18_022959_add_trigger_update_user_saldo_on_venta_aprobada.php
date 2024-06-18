<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {
            DB::unprepared('
                CREATE TRIGGER update_user_saldo_after_venta_update
                AFTER UPDATE ON ventas
                FOR EACH ROW
                BEGIN
                    -- Si el estado cambia a "Aprobada" desde cualquier otro estado
                    IF NEW.estado = \'Aprobada\' AND OLD.estado != \'Aprobada\' THEN
                        UPDATE users
                        SET saldo = saldo + (NEW.valor_total * 0.10)
                        WHERE id = NEW.user_id;
                    -- Si el estado cambia a "Pendiente" o "Rechazada" desde "Aprobada"
                    ELSEIF (NEW.estado = \'Pendiente\' OR NEW.estado = \'Rechazada\') AND OLD.estado = \'Aprobada\' THEN
                        UPDATE users
                        SET saldo = saldo - (OLD.valor_total * 0.10)
                        WHERE id = NEW.user_id;
                    -- Si el valor_total cambia mientras el estado es "Aprobada"
                    ELSEIF NEW.estado = \'Aprobada\' AND OLD.estado = \'Aprobada\' AND NEW.valor_total != OLD.valor_total THEN
                        UPDATE users
                        SET saldo = saldo - (OLD.valor_total * 0.10) + (NEW.valor_total * 0.10)
                        WHERE id = NEW.user_id;
                    END IF;
                END
            ');
            Log::info('Trigger update_user_saldo_after_venta_update created successfully.');
        } catch (\Exception $e) {
            Log::error('Error creating trigger: ' . $e->getMessage());
        }
    }

    public function down()
    {
        try {
            DB::unprepared('
                DROP TRIGGER IF EXISTS update_user_saldo_after_venta_update
            ');
            Log::info('Trigger update_user_saldo_after_venta_update dropped successfully.');
        } catch (\Exception $e) {
            Log::error('Error dropping trigger: ' . $e->getMessage());
        }
    }
};
