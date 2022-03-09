<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleVentasFabricasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_ventas_fabricas', function (Blueprint $table) {
            $table->id();
            $table->decimal('precio',10,2)->default(0);
            $table->integer('cantidad')->default(0);
            $table->decimal('costo',10,2)->default(0);
            $table->decimal('comision',10,2)->default(0);
            $table->decimal('descuento',10,2)->default(0);

            $table->unsignedBigInteger('producto_id');
            $table->foreign('producto_id')->references('id')->on('productos_fabricas');

            $table->unsignedBigInteger('ventas_id');
            $table->foreign('ventas_id')->references('id')->on('ventas_fabricas')->onDelete('cascade');

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
        Schema::dropIfExists('detalle_ventas_fabricas');
    }
}
