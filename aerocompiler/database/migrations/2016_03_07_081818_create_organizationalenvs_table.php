<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrganizationalenvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('organizationalenvs', function(Blueprint $table) {
                $table->increments('id');
                $table->integer('userId');
                $table->integer('reportId');
                $table->integer('opId');
                $table->char('opSubId');
                $table->integer('opInnerId');
                $table->text('f1');
                $table->text('f2');
                $table->text('f3');

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
        Schema::drop('organizationalenvs');
    }

}
