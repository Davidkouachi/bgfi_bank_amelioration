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
            $table->string('action')->nullable();
            $table->date('delai')->nullable();
            $table->string('statut')->nullable();
            $table->string('type')->nullable();
            $table->unsignedBigInteger('poste_id')->nullable();
            $table->foreign('poste_id')->references('id')->on('postes');
            $table->unsignedBigInteger('risque_id')->nullable();
            $table->foreign('risque_id')->references('id')->on('risques');
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
