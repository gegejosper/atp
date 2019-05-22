<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGassalesreportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gassalesreports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('branchid');
            $table->string('branchpumpid');
            $table->string('openingvolume');
            $table->string('closingvolume');
            $table->string('consumevolume');
            $table->string('unitprice');
            $table->string('amount');
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
        Schema::dropIfExists('gassalesreports');
    }
}
