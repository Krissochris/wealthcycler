<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangesToDecimalColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('virtual_provide_donations', function (Blueprint $table) {
            $table->decimal('amount', 20, 2)->default(0.00)->change();
        });

        Schema::table('get_donations', function (Blueprint $table) {
            $table->decimal('amount', 20, 2)->default(0.00)->change();
        });

        Schema::table('virtual_merges', function (Blueprint $table) {
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
        Schema::table('virtual_provide_donations', function (Blueprint $table) {
            $table->decimal('amount', 8, 2)->default(0.00)->change();
        });

        Schema::table('get_donations', function (Blueprint $table) {
            $table->decimal('amount', 8, 2)->default(0.00)->change();
        });

        Schema::table('virtual_merges', function (Blueprint $table) {
            $table->decimal('amount', 8, 2)->default(0.00)->change();
        });
    }
}
