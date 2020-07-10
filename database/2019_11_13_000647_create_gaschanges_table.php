<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGaschangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gaschanges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('branchid');
            $table->string('branchgasid');
            $table->string('volumeedit');
            $table->string('priceedit');
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
        Schema::dropIfExists('gaschanges');
    }
}
