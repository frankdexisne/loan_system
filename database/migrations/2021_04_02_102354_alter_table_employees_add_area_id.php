<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableEmployeesAddAreaId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('dbpayroll')->table('employees', function (Blueprint $table) {
            $table->bigInteger('area_id')->nullable($value=true)->unsigned()->after('user_id');
            $table->foreign('area_id')->references('id')->on('dbloans.areas')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
