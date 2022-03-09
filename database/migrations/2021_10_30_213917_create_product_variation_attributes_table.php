<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVariationAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variation_attributes', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('variation_id')->default(0);
            $table->unsignedInteger('attribute_id')->nullable(); // default(0);
            $table->string('attribute_value');
            $table->timestamps();
            $table->foreign('variation_id')->references('id')->on('product_has_variations');
            $table->foreign('attribute_id')->references('id')->on('variations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_variation_attributes');
    }
}
