<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutorisationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('autorisations', function (Blueprint $table) {
            $table->id();
            
            $table->string('new_user');
            $table->string('list_user');
            $table->string('new_poste');
            $table->string('list_poste');
            $table->string('historiq');
            $table->string('stat');

            $table->string('new_proces');
            $table->string('list_proces');

            $table->string('new_recla');
            $table->string('verif_recla');
            $table->string('recla_non_a');
            $table->string('list_recla');

            $table->string('list_cause');
            $table->string('list_r_r');

            $table->string('controle_action');
            $table->string('list_action');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('autorisations');
    }
}
