<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchdiscountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branchdiscounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('branchid');
            $table->string('userid');
            $table->string('account');
            $table->string('gasname');
            $table->string('amount');
            $table->string('platenum');
            $table->string('discountdate');
            $table->string('discountsession');
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
        Schema::dropIfExists('branchdiscounts');
    }
}
