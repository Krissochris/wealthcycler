<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeAmountVirtualWalletTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('virtual_wallet_transactions', function (Blueprint $table) {
            $table->decimal('amount', 20, 2)->default(0.00)->change();
        });

        Schema::table('user_saving_wallet_transactions', function (Blueprint $table) {
            $table->decimal('amount', 20, 2)->default(0.00)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('virtual_wallet_transactions', function (Blueprint $table) {
            $table->decimal('amount')->change();
        });

        Schema::table('user_saving_wallet_transactions', function (Blueprint $table) {
            $table->decimal('amount')->change();
        });
    }
}
