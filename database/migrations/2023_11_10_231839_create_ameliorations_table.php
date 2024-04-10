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
            $table->date('date_limite');
            $table->date('date_cloture1')->nullable();
            $table->string('lieu');
            $table->string('detecteur');
            $table->text('consequences');
            $table->text('causes');
            $table->text('reclamations');
            $table->string('choix_select');
            $table->string('statut');
            $table->string('escaladeur');
            $table->string('nbre_traitement');
            $table->datetime('date_validation')->nullable();
            $table->date('date1')->nullable();
            $table->date('date2')->nullable();
            $table->string('efficacite')->nullable();
            $table->text('commentaire_eff')->nullable();
            $table->date('date_eff')->nullable();
            $table->unsignedBigInteger('reclamation_id')->nullable();
            $table->foreign('reclamation_id')->references('id')->on('reclamations');
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
        Schema::dropIfExists('ameliorations');
    }
}
