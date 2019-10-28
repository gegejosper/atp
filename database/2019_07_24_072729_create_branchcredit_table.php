<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchcreditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branchcredits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('branchid');
            $table->string('userid');
            $table->string('accountid');
            $table->string('account');
            $table->string('gasname');
            $table->string('invoice');
            $table->string('liters');
            $table->string('amount');
            $table->string('creditplatenum');
            $table->string('creditdate');
            $table->string('creditsession');
            $table->string('creditstatus');
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
        Schema::dropIfExists('branchcredits');
    }
}
