<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('clients')->unsigned();

            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')->unsigned();

            $table->bigInteger('term_id')->unsigned();
            $table->foreign('term_id')->references('id')->on('terms')->unsigned();

            $table->bigInteger('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('statuses')->unsigned();

            $table->string('transaction_code')->unique();
            $table->date('date_loan');
            $table->date('date_release')->nullable($value=true);
            $table->date('first_payment')->nullable($value=true);
            $table->date('maturity_date')->nullable($value=true);
            $table->double('loan_amount');
            $table->double('interest');
            $table->double('settled');
            $table->double('balance');
            $table->double('over');
            $table->double('payment_per_sched');
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
        Schema::dropIfExists('loans');
    }
}
