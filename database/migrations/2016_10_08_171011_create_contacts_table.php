<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstName', 25);
            $table->string('lastName', 30);
            $table->string('protectedEmail')->unique()->nullable();
            $table->string('protectedPhoneNumber', 30)->nullable();
            $table->timestamps();
            $table->tinyInteger('archived')->default(0);
        });

        Schema::create('contact_event', function (Blueprint $table) {
            $table->integer('contact_id')->unsigned()->index();
            $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('cascade');

            $table->integer('event_id')->unsigned()->index();
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');

            $table->string('title');
            $table->timestamps();
        });

        Schema::create('contact_resource', function (Blueprint $table) {
            $table->integer('contact_id')->unsigned()->index();
            $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('cascade');

            $table->integer('resource_id')->unsigned()->index();
            $table->foreign('resource_id')->references('id')->on('resources')->onDelete('cascade');

            $table->string('title');
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
        Schema::drop('contact_event');
        Schema::drop('contact_resource');
        Schema::drop('contacts');
        
    }
}
