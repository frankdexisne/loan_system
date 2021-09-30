<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyTransactionReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_transaction_reports', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('payment_mode_id')->unsigned();
            $table->foreign('payment_mode_id')->references('id')->on('payment_modes')->unsigned();
            $table->bigInteger('prev_transaction_id')->nullable($value=true)->unsigned();
            $table->foreign('prev_transaction_id')->references('id')->on('daily_transaction_reports')->unsigned();
            $table->double('principal');
            $table->double('net');
            $table->double('coh');
            $table->timestamps();
            // $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daily_transaction_reports');
    }
}
