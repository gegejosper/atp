<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchpumplogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pumplogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('branchid');
            $table->string('userid');
            $table->string('logsession');
            $table->string('gasid');
            $table->string('pumpid');
            $table->string('consumevolume');
            $table->string('openvolume');
            $table->string('closevolume');
            $table->string('unitprice');
            $table->string('amount');
            $table->string('datelog');
            $table->string('batchcode');
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
        Schema::dropIfExists('pumplogs');
    }
}
