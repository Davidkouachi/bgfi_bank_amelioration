<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actions', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->nullable();
            $table->string('actions')->nullable();
            $table->unsignedBigInteger('poste_id')->nullable();
            $table->foreign('poste_id')->references('id')->on('postes');
            $table->unsignedBigInteger('cause_id')->nullable();
            $table->foreign('cause_id')->references('id')->on('causes');
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
        Schema::dropIfExists('actions');
    }
}
