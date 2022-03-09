<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('identification_id')->default(0);
            $table->string('business_name', 100);
            $table->unsignedBigInteger('address_id')->default(0);
            $table->unsignedBigInteger('contact_id')->default(0);
            $table->string('logo', 500)->nullable();
            $table->timestamps();
            $table->foreign('address_id')->references('id')->on('address');
            $table->foreign('contact_id')->references('id')->on('contact');
            $table->foreign('identification_id')->references('id')->on('identifications');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shops');
    }
}
