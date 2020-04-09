<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVirtualMergesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('virtual_merges', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('provide_donation_id');
            $table->unsignedInteger('get_donation_id');
            $table->decimal('amount', 8, 2)->default(0.00);
            $table->smallInteger('status')->default(1);
            $table->timestamps();
            $table->timestamp('completed_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('virtual_merges');
    }
}
