<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRisquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('risques', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->integer('vraisemblence');
            $table->integer('gravite');
            $table->integer('evaluation');
            $table->string('cout');
            $table->string('traitement');
            $table->string('statut');
            $table->integer('vraisemblence_residuel');
            $table->integer('gravite_residuel');
            $table->integer('evaluation_residuel');
            $table->string('cout_residuel');
            $table->datetime('date_validation')->nullable();
            $table->unsignedBigInteger('processus_id');
            $table->foreign('processus_id')->references('id')->on('processuses');
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
        Schema::dropIfExists('risques');
    }
}
