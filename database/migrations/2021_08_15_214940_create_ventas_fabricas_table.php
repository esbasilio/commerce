<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasFabricasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas_fabricas', function (Blueprint $table) {
            $table->id();
            $table->integer('comercio_id')->default(0);
            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('users');
            $table->string('tipo_identificacion',20);
            $table->string('num_venta',20);
            $table->dateTime('fecha_venta');
            $table->decimal('total',11, 2);
            $table->decimal('impuesto',11, 2);
            $table->string('estado',20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas_fabricas');
    }
}
