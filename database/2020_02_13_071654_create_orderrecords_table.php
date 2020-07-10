<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderrecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderrecords', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('checkdate');
            $table->string('bankname');
            $table->string('checknum');
            $table->string('amount');
            $table->string('userid');
            $table->string('status');
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
        Schema::dropIfExists('orderrecords');
    }
}
