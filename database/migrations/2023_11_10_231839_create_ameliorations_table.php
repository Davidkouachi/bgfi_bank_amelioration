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
            $table->string('type');
            $table->date('date_fiche');
            $table->string('lieu');
            $table->string('detecteur');
            $table->string('non_conformite');
            $table->text('consequence');
            $table->text('cause');
            $table->string('choix_select');
            $table->string('nature');
            $table->string('risque');
            $table->string('resume');
            $table->string('action');
            $table->date('date_action');
            $table->string('commentaire');
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
        Schema::dropIfExists('ameliorations');
    }
}
