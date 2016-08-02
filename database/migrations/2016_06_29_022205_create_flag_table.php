<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flag', function (Blueprint $table) {
            $table->increments('Id');
            $table->date('Date');
            //0-addressed, 1-GA, 2-Admin
            $table->integer('Level');
            $table->text('Comments');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('resource_id')->unsigned();
            $table->foreign('resource_id')->references('Id')->on('Resource');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Flag');
    }
}
