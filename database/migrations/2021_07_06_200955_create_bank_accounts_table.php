<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('type_account');
            $table->string('account');
            $table->string('cedula');
            $table->string('phone');
            $table->string('beneficiary');
            $table->string('type_d');
            $table->string('pm');
            $table->unsignedBigInteger('bank_id');
            $table->timestamps();
            $table->foreign('bank_id')->references('id')->on('banks')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bank_accounts');
    }
}
