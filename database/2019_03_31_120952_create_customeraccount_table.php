<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomeraccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customeraccounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('accountid');
            $table->string('branchid');
            $table->string('name');
            $table->string('invoicenum');
            $table->string('charge');
            $table->string('credit');
            $table->string('balance');
            $table->string('invoicedate');
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
        Schema::dropIfExists('customeraccounts');
    }
}
