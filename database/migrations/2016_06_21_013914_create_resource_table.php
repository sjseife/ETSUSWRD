<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResourceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Resource', function(Blueprint $table) {
           $table->increments('Id');
           $table->string('Name', 150);
           $table->string('StreetAddress', 50);
           $table->string('StreetAddress2', 25);
           $table->string('City', 40);
           $table->string('County', 15);
           $table->string('State', 2);
           $table->string('Zipcode', 5);
           $table->time('OpeningHours');
           $table->time('ClosingHours');
           $table->text('Comments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Resource');
    }
}
