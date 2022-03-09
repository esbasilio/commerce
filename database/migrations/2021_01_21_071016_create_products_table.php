<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('comercio_id')->default(0);
            $table->string('barcode')->nullable();
            $table->decimal('cost')->default(0);
            $table->decimal('price')->default(0);
            $table->integer('stock')->default(0);
            $table->integer('alerts')->default(0);
            $table->string('image')->nullable();
            $table->unsignedBigInteger('seccionalmacen_id')->default(0);
            $table->unsignedBigInteger('category_id');

            $table->foreign('seccionalmacen_id')->references('id')->on('seccionalmacens');
            $table->foreign('category_id')->references('id')->on('categories');
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
        Schema::dropIfExists('products');
    }
}
