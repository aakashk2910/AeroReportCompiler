<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateScoretablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('scoretables', function(Blueprint $table) {
                $table->increments('id');
                $table->integer('subCriteriaId')->unsigned();
                $table->integer('maxScore');
                $table->foreign('subCriteriaId')->references('id')->on('subcriterias')->onDelete('cascade');

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
        Schema::drop('scoretables');
    }

}
