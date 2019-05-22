<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCashsalesreportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cashsalesreports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cashierid');
            $table->string('branchid');
            $table->string('productid');
            $table->string('cashtype');
            $table->string('amount');
            $table->string('quantity');
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
        Schema::dropIfExists('cashsalesreports');
    }
}
