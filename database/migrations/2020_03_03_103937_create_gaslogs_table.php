<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGaslogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gaslogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('record_number');
            $table->string('branch_id');
            $table->string('gas_id');
            $table->string('volume');
            $table->string('log_type');
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
        Schema::dropIfExists('gaslogs');
    }
}
