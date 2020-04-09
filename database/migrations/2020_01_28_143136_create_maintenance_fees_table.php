<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaintenanceFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenance_fees', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('amount', 5, 2);
            $table->unsignedInteger('get_donation_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('package_id');
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
        Schema::dropIfExists('maintenance_fees');
    }
}
