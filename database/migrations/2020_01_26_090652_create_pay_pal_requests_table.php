<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayPalRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_pal_requests', function (Blueprint $table) {
            $table->string('id')->unique()->primary();
            $table->string('intent');
            $table->string('item_no');
            $table->string('payment_method');
            $table->string('transaction_amount');
            $table->string('transaction_currency');
            $table->string('transaction_description');
            $table->string('transaction_invoice_number');
            $table->string('state');
            $table->smallInteger('value_given');
            $table->string('create_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pay_pal_requests');
    }
}
