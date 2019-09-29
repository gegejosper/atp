<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchotherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branchothers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('branchid');
            $table->string('userid');
            $table->string('desc');
            $table->string('amount');
            $table->string('descsession');
            $table->string('othersdate');
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
        Schema::dropIfExists('branchothers');
    }
}
