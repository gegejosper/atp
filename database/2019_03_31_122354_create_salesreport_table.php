<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesreportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salesreports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cashierid');
            $table->string('branchid');
            $table->string('productamount')->nullable(false)->change();
            $table->string('cashamount')->nullable(false)->change();
            $table->string('creditamount')->nullable(false)->change();
            $table->string('discounts')->nullable(false)->change();
            $table->string('vouchersamount')->nullable(false)->change();
            $table->string('shortageamount')->nullable(false)->change();
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
        Schema::dropIfExists('salesreports');
    }
}
