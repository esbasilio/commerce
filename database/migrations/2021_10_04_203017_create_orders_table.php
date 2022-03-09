<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('status_id')->default(0);
            $table->integer('person_id')->default(0);
            $table->unsignedBigInteger('shop_id')->default(0);
            $table->unsignedBigInteger('payment_type_id')->default(0);
            $table->decimal('total')->default(0);
            $table->timestamps();
            $table->foreign('shop_id')->references('id')->on('shops');
            $table->foreign('payment_type_id')->references('id')->on('payment_types');
            $table->foreign('status_id')->references('id')->on('order_statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
