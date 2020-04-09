<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDebitWalletTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * This table tracks all the withdrawals in the savings account
     */
    public function up()
    {
        Schema::create('user_debit_wallets', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->decimal('amount', 20, 4)->default(0.00);
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
        Schema::dropIfExists('user_debit_wallets');
    }
}
