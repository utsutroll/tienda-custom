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
            $table->BigInteger('id')->unsigned()->unique();
            $table->string('name');
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('presentation_id')->unsigned();
            $table->string('slug')->unique();
            $table->text('details');
            $table->decimal('price', 11, 2)->nullable()->default('0');
            $table->decimal('sale_price', 11, 2)->nullable()->default('0');
            $table->integer('stock')->nullable()->default('0');
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('restrict');
            $table->foreign('presentation_id')->references('id')->on('presentations')->onDelete('restrict');
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
