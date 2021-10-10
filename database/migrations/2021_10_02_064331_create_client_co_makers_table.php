<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientCoMakersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_co_makers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('client_id')->unsigned()->index();
            $table->foreign('client_id')->references('id')->on('clients')->unsigned();
            $table->bigInteger('co_maker_id')->unsigned()->index();
            $table->foreign('co_maker_id')->references('id')->on('co_makers')->unsigned();
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
        Schema::dropIfExists('client_co_makers');
    }
}
