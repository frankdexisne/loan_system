<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoMakersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('co_makers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('clients')->unsigned();
            $table->string('avatar')->nullable($value=true);
            $table->string('lname');
            $table->string('fname');
            $table->string('mname');
            $table->unique(['lname','fname','mname']);
            $table->date('dob');
            $table->string('gender');
            $table->string('contact_no');
            $table->string('company');
            $table->string('position');
            $table->double('monthly_salary');
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
        Schema::dropIfExists('co_makers');
    }
}
