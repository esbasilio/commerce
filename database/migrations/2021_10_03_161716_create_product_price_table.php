<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductPriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_prices', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->default(0);
            $table->string('product_type', 5); // product -> prod / variation -> var
            $table->decimal('price')->default(0);
            $table->unsignedBigInteger('price_list_id')->default(0);
            $table->timestamps();
            $table->foreign('price_list_id')->references('id')->on('product_price_lists');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_price');
    }
}
