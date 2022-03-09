<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PreventativeHasClients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preventative_has_clients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('preventist_id')->default(0);
            $table->unsignedBigInteger('client_id')->default(0);
            $table->unsignedBigInteger('shop_id')->default(0);
            $table->timestamps();
            $table->foreign('preventist_id')->references('id')->on('users');
            $table->foreign('client_id')->references('id')->on('users');
            $table->foreign('shop_id')->references('id')->on('shops');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
