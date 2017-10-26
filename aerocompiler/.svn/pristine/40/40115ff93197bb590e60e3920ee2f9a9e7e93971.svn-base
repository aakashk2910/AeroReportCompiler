<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('scores', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('userId')->unsigned();
            $table->integer('subCriteriaId')->unsigned();
            $table->integer('reportId')->unsigned();
            $table->integer('score');
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('subCriteriaId')->references('id')->on('subcriterias')->onDelete('cascade');
            $table->foreign('reportId')->references('id')->on('reports')->onDelete('cascade');

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
        Schema::drop('scores');
    }

}
