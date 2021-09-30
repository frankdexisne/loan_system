<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableLoansAddPsAndCbuId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->bigInteger('ps_id')->nullable($value=true)->unsigned()->after('status_id');
            $table->foreign('ps_id')->references('id')->on('transactions')->unsigned();

            $table->bigInteger('cbu_id')->nullable($value=true)->unsigned()->after('ps_id');
            $table->foreign('cbu_id')->references('id')->on('transactions')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('loans', function (Blueprint $table) {
            //
        });
    }
}
