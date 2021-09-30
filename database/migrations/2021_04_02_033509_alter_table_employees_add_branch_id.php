<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableEmployeesAddBranchId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('dbpayroll')->table('employees', function (Blueprint $table) {
            $table->bigInteger('job_title_id')->nullable($value=true)->unsigned()->after('gender');
            $table->foreign('job_title_id')->references('id')->on('dbpayroll.job_titles')->unsigned();
            $table->bigInteger('branch_id')->nullable($value=true)->unsigned()->after('job_title_id');
            $table->foreign('branch_id')->references('id')->on('dbloans.branches')->unsigned();
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
