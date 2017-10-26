<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSuborganizationalprofilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('suborganizationalprofiles', function(Blueprint $table) {
                $table->increments('id');
                $table->integer('opSubId');
                $table->integer('opId');
                $table->string('opSubName');

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
        Schema::drop('suborganizationalprofiles');
    }

}
