<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryAdressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_adresses', function (Blueprint $table) {
          $table->id();
          $table->integer('order_id');
          $table->integer('customer_id');
          $table->string('name');
          $table->string('email');
          $table->string('phone');
          $table->integer('post_code');
          $table->string('city');
          $table->string('street');
          $table->string('house_number');
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
        Schema::dropIfExists('delivery_adresses');
    }
}
