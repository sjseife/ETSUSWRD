<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 150);
            $table->date('startDate');
            $table->date('endDate');
            $table->string('streetAddress', 50);
            $table->string('streetAddress2', 25);
            $table->string('city', 40);
            $table->string('county', 15);
            $table->string('state', 2);
            $table->string('zipCode', 5);
            $table->string('publicPhoneNumber', 30)->nullable();
            $table->string('publicEmail')->nullable();
            $table->string('website')->nullable();
            $table->text('description');
            $table->text('comments');
            $table->timestamps();
            $table->tinyInteger('archived')->default(0);
        });

        Schema::create('event_user', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('event_id')->unsigned()->index();
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     *
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('event_user');
        Schema::drop('events');
    }
}
