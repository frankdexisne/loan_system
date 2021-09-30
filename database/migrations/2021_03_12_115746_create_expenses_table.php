<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('expense_type_id')->unsigned();
            $table->foreign('expense_type_id')->references('id')->on('expense_types')->unsigned();
            $table->date('expense_date');
            $table->string('ornos');
            $table->bigInteger('employee_id')->nullable($value=true)->unsigned();
            $table->foreign('employee_id')->references('id')->on('dbpayroll.employees')->unsigned();
            $table->string('description');
            $table->double('amount');
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
        Schema::dropIfExists('expenses');
    }
}
