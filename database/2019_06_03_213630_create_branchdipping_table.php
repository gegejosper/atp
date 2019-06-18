<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchdippingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branchdippings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('branchid');
            $table->string('gasid');
            $table->string('dipvolume');
            $table->string('dipopenvolume');
            $table->string('dipclosevolume');
            $table->string('dippingdate');
            $table->string('type');
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
        Schema::dropIfExists('branchdippings');
    }
}
