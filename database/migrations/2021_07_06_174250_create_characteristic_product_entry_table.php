<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharacteristicProductEntryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characteristic_product_entry', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('characteristic_product_id');
            $table->unsignedBigInteger('entry_id');
            
            $table->integer('quantity');
            $table->timestamps();

            $table->foreign('characteristic_product_id')->references('id')->on('characteristic_product')->onDelete('restrict');
            $table->foreign('entry_id')->references('id')->on('entries')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('characteristic_product_entry');
    }
}
