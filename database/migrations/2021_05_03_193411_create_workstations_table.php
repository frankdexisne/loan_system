<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkstationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('dbsystem')->create('workstations', function (Blueprint $table) {
            $table->id();
            $table->string('workstation_name')->unique();
            $table->string('workstation_description');
            $table->string('encrypted_ws');
            $table->bigInteger('branch_id')->nullable($value=true);
            $table->tinyInteger('allowed')->default(0);
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
        Schema::dropIfExists('workstations');
    }
}
