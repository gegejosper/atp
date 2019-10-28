<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchpaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branchpayments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('userid');
            $table->string('branchid');
            $table->string('billid');
            $table->string('accountid');
            $table->string('payment');
            $table->string('balance');
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
        Schema::dropIfExists('branchpayments');
    }
}
