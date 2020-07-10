<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountcreditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accountcredits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('creditdate');
            $table->string('invoicenum');
            $table->string('accountid');
            $table->string('quantity');
            $table->string('product');
            $table->string('unitprice');
            $table->string('amount');
            $table->string('platenumber');
            $table->string('credittype');
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
        Schema::dropIfExists('accountcredits');
    }
}
