<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInnerorganizationalprofilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('innerorganizationalprofiles', function(Blueprint $table) {
                $table->increments('id');
                $table->integer('opInnerId');
$table->integer('opSubId');
$table->string('opInnerName');

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
        Schema::drop('innerorganizationalprofiles');
    }

}
