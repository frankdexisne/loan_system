<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoMakerAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('co_maker_addresses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('co_maker_id')->unsigned();
            $table->foreign('co_maker_id')->references('id')->on('co_makers')->unsigned();
            $table->integer('philippine_barangay_id')->unsigned();
            $table->foreign('philippine_barangay_id')->references('id')->on('dbsystem.philippine_barangays')->unsigned();
            $table->string('street')->nullable($value=true);
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
        Schema::dropIfExists('co_maker_addresses');
    }
}
