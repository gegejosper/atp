<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGasrecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gasrecords', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('branchgasid');
            $table->string('gasid');
            $table->string('branchid');
            $table->string('oldprice');
            $table->string('newprice');
            $table->string('oldvolume');
            $table->string('newvolume');
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
        Schema::dropIfExists('gasrecords');
    }
}
