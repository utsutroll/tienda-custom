<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharacteristicProductOutputTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characteristic_product_output', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('characteristic_product_id');
            $table->unsignedBigInteger('output_id');
            $table->integer('quantity');
            $table->text('observation');
            $table->timestamps();
            $table->foreign('characteristic_product_id')->references('id')->on('characteristic_product')->onDelete('restrict');
            $table->foreign('output_id')->references('id')->on('outputs')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('characteristic_product_output');
    }
}
