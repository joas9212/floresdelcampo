<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('venta_id')->constrained('ventas')->onDelete('cascade');
            $table->foreignId('ciudad_id')->constrained('ciudades');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('nombre_destinatario');
            $table->string('numero_contacto_destinatario');
            $table->string('direccion_destionatario');
            $table->string('mensaje_dedicatoria');
            $table->string('observaciones');
            $table->datetime('fecha_envio');
            $table->decimal('costo_envio', 8, 2);
            $table->enum('estado', ['Pendiente', 'Aceptado', 'Rechazado'])->default('Pendiente');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
};
