<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pics', function(Blueprint $table) {
            $table->increments('id');
            $table->string('userId');
            $table->string('filename');
            $table->string('mime');
            $table->string('original_filename');
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('profession');
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
        Schema::drop('pics');
    }
}
