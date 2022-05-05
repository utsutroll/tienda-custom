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
            $table->bigInteger('user_id')->unsigned();
            $table->decimal('discount')->default(0);
            $table->decimal('total');
            $table->decimal('total_bs', 11,2);
            $table->string('cedula');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('mobile');
            $table->enum('status',['ordered', 'delivered', 'canceled'])->default('ordered');
            $table->boolean('is_shipping_diferent')->default(false);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
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
