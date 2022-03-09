<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->default(0);
            $table->unsignedBigInteger('identification_id')->default(0);
            $table->string('name', 50);
            $table->string('last_name', 50);
            $table->unsignedBigInteger('address_id')->default(0);
            $table->unsignedBigInteger('contact_id')->default(0);
            $table->text('references')->nullable();
            $table->timestamps();
            $table->foreign('identification_id')->references('id')->on('identifications');
            $table->foreign('address_id')->references('id')->on('address');
            $table->foreign('contact_id')->references('id')->on('contact');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
