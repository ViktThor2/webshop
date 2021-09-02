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
            $table->double('netto');
            $table->double('vat_sum');
            $table->integer('vat_id');
            $table->integer('brutto');
            $table->integer('qty');
            $table->integer('main_category_id');
            $table->integer('sub_category_id');
            $table->integer('brand_id');
            $table->integer('amount_unit_id');  
            $table->longText('description');
            $table->boolean('active');
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
