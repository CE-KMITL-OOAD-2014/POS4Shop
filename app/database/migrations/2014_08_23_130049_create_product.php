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
        Schema::create('products', function ($table) {
            $table->increments('id');
            $table->string('barcode', 50)->unique();
            $table->string('name', 200);
            $table->text('detail');
            $table->float('cost',8,4);
            $table->float('price',8,4);
            $table->string('img_filename', 200); //TODO (ziko) : add this in Class diagram
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
