<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('account_no')->unique();
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
            
            $table->bigInteger('area_id')->unsigned();
            $table->foreign('area_id')->references('id')->on('areas')->unsigned();

            $table->bigInteger('group_id')->nullable($value=true)->unsigned();
            $table->foreign('group_id')->references('id')->on('groups')->unsigned();

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
        Schema::dropIfExists('clients');
    }
}
