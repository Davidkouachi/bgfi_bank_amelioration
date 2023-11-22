<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmeliorationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ameliorations', function (Blueprint $table) {
            $table->id();
            $table->date('date_fiche');
            $table->string('lieu');
            $table->string('detecteur');
            $table->text('consequences');
            $table->text('causes');
            $table->text('reclamations');
            $table->string('nature');
            $table->string('choix_select');
            $table->text('commentaires');
            $table->unsignedBigInteger('action_id');
            $table->foreign('action_id')->references('id')->on('actions');
            $table->unsignedBigInteger('processus_id');
            $table->foreign('processus_id')->references('id')->on('processuses');
            $table->unsignedBigInteger('reclamation_id');
            $table->foreign('reclamation_id')->references('id')->on('reclamations');
            $table->unsignedBigInteger('cause_id');
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
        Schema::dropIfExists('ameliorations');
    }
}
