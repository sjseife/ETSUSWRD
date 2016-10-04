<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Name', 150);
            $table->string('StreetAddress', 50);
            $table->string('StreetAddress2', 25);
            $table->string('City', 40);
            $table->string('County', 15);
            $table->string('State', 2);
            $table->string('Zipcode', 5);
            $table->string('PhoneNumber', 150);
            $table->time('OpeningHours');
            $table->time('ClosingHours');
            $table->text('Comments');
            $table->timestamps();
        });

        Schema::create('resource_user', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('resource_id')->unsigned()->index();
            $table->foreign('resource_id')->references('id')->on('resources')->onDelete('cascade');

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
        Schema::drop('resources');
        Schema::drop('resource_user');
    }
}
