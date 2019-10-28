<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountbillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accountbills', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('accountid');
            $table->string('branchid');
            $table->string('billnum');
            $table->string('billdate');
            $table->string('balance');
            $table->string('discount');
            $table->string('amount');
            $table->string('billstatus');
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
        Schema::dropIfExists('accountbills');
    }
}
