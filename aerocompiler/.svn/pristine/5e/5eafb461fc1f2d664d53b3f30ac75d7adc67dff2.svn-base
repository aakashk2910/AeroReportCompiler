<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInputsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('forminputs', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('userId')->unsigned();
            $table->integer('subCriteriaId')->unsigned();
            $table->integer('labelId')->unsigned();
            $table->longText('labelText');
            $table->boolean('A');
            $table->boolean('D');
            $table->boolean('L');
            $table->boolean('I');
            $table->foreign('labelId')->references('id')->on('formlabels')->onDelete('cascade');
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
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
        Schema::drop('forminputs');
    }
}
