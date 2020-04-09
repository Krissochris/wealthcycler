<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatingForeignKeysInTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('state_id')->references('id')->on('states')
                ->onUpdate('CASCADE')
                ->onDelete('RESTRICT');
            $table->foreign('country_id')->references('id')->on('countries')
                ->onUpdate('CASCADE')
                ->onDelete('RESTRICT');
        });


        Schema::table('user_payment_details', function (Blueprint $table) {
            $table->foreign('bank_id')->references('id')->on('banks')
                ->onUpdate('CASCADE')
                ->onDelete('RESTRICT');
        });

        Schema::table('user_saving_wallets', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('CASCADE')
                ->onDelete('RESTRICT');
        });

        Schema::table('user_debit_wallets', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('CASCADE')
                ->onDelete('RESTRICT');
        });

        Schema::table('virtual_wallets', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('CASCADE')
                ->onDelete('RESTRICT');
        });

        /** virtual provide donation */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_state_id_foreign');
            $table->dropForeign('users_country_id_foreign');
        });

        Schema::table('user_payment_details', function (Blueprint $table) {
            $table->dropForeign('user_payment_details_bank_id_foreign');
        });

        Schema::table('virtual_wallets', function (Blueprint $table) {
            $table->dropForeign('virtual_wallets_user_id_foreign');
        });

        Schema::table('user_saving_wallets', function (Blueprint $table) {
            $table->dropForeign('user_saving_wallets_user_id_foreign');
        });

        Schema::table('user_debit_wallets', function (Blueprint $table) {
            $table->dropForeign('user_debit_wallets_user_id_foreign');
        });
    }
}
