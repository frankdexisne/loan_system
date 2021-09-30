<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('client_id')->nullable($value=true)->unsigned();
            $table->foreign('client_id')->references('id')->on('clients')->unsigned();
            
            $table->bigInteger('loan_id')->nullable($value=true)->unsigned();
            $table->foreign('loan_id')->references('id')->on('loans')->unsigned();


            $table->string('orno')->unique();
            $table->date('payment_date');

            $table->double('amount');

            $table->bigInteger('ps_id')->nullable($value=true)->unsigned();
            $table->foreign('ps_id')->references('id')->on('transactions')->unsigned();

            $table->bigInteger('cbu_id')->nullable($value=true)->unsigned();
            $table->foreign('cbu_id')->references('id')->on('transactions')->unsigned();

            $table->bigInteger('ins_id')->nullable($value=true)->unsigned();
            $table->foreign('ins_id')->references('id')->on('transactions')->unsigned();

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
        Schema::dropIfExists('payments');
    }
}
