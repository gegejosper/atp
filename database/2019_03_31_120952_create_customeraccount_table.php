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
            $table->string('customerid');
            $table->string('name')->nullable(false)->change();
            $table->string('invoicenum')->nullable(false)->change();
            $table->string('charge')->nullable(false)->change();
            $table->string('credit')->nullable(false)->change();
            $table->string('balance')->nullable(false)->change();
            $table->string('invoicedate')->nullable(false)->change();
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
