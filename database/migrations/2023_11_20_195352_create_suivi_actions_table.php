<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuiviActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suivi_actions', function (Blueprint $table) {
            $table->id();
            $table->string('efficacite')->nullable();
            $table->text('commentaires')->nullable();
            $table->date('date_action')->nullable();
            $table->date('delai');
            $table->string('statut');
            $table->string('nature');
            $table->string('commentaire_am');
            $table->dateTime('date_suivi')->nullable();
            $table->unsignedBigInteger('action_id');
            $table->foreign('action_id')->references('id')->on('actions');
            $table->unsignedBigInteger('processus_id');
            $table->foreign('processus_id')->references('id')->on('processuses');
            $table->unsignedBigInteger('amelioration_id');
            $table->foreign('amelioration_id')->references('id')->on('ameliorations');
            $table->unsignedBigInteger('cause_id');
            $table->foreign('cause_id')->references('id')->on('causes');
            $table->unsignedBigInteger('reclamation_id');
            $table->foreign('reclamation_id')->references('id')->on('reclamations');
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
        Schema::dropIfExists('suivi_actions');
    }
}
