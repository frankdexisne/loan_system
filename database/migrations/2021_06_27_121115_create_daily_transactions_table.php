<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('payment_mode_id')->unsigned();
            $table->foreign('payment_mode_id')->references('id')->on('payment_modes')->unsigned();
            $table->double('release_todate');
            $table->double('principal_amount');
            $table->double('release_net_todate');
            $table->double('coh');
            $table->double('reimbursement');
            $table->double('release');
            $table->double('release_net');
            $table->double('expense');
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
        Schema::dropIfExists('daily_transactions');
    }
}
