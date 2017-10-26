<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubcriteriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('subcriterias', function(Blueprint $table) {
                $table->increments('id');
                $table->integer('subCriteriaId');
                $table->integer('criteriaId')->unsigned();
                $table->string('subCriteriaName');
                //$table->foreign('criteriaId')->references('criteriaId')->on('criterias');
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
        Schema::drop('subcriterias');
    }

}
