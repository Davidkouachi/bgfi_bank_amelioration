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
            $table->string('statut');
            $table->string('nature');
            $table->string('commentaire_am');
            $table->dateTime('date_suivi')->nullable();
            $table->unsignedBigInteger('action_id');
            $table->foreign('action_id')->references('id')->on('actions');
            $table->unsignedBigInteger('amelioration_id');
            $table->foreign('amelioration_id')->references('id')->on('ameliorations');
            $table->unsignedBigInteger('poste_id');
            $table->foreign('poste_id')->references('id')->on('postes');
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
