<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistory extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('histories', function ($table) {
            $table->increments('id');
            $table->integer('hid');
            $table->integer('product_id');
            $table->float('quantity',8,4);
            $table->float('price',8,4);
            $table->integer('customer_id')->nullable(true);
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
        Schema::drop('histories');
    }

}
