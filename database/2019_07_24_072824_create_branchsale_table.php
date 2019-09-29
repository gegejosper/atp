<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchsaleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branchsales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('branchid');
            $table->string('userid');
            $table->string('account');
            $table->string('product');
            $table->string('invoice');
            $table->string('amount');
            $table->string('price');
            $table->string('quantity');
            $table->string('paymenttype');
            $table->string('saledate');
            $table->string('salesession');
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
        Schema::dropIfExists('branchsales');
    }
}
