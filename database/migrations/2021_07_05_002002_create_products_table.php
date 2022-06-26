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
            $table->bigInteger('subcategory_id')->unsigned();
            $table->bigInteger('brand_id')->unsigned();
            $table->text('details');
            $table->decimal('price', 11, 2)->nullable()->default('0');
            $table->integer('stock')->nullable()->default('0');
            $table->string('slug')->unique();
            $table->timestamps();
            $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('restrict');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('restrict');
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
