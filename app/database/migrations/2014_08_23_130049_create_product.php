<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduct extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products, function ($table) {
            $table->increments('id');
            $table->string('barcode', 45)->unique();;
            $table->string('name', 250);
            $table->string('detail');
            $table->string('price', 45);
            $table->string('img_filename', 200);
            $table->integer('item_sold')->default(0);
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
        Schema::drop('products');
    }

}
