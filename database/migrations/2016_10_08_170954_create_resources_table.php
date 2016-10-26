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
            $table->string('name', 150);
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
            $table->integer('provider_id')->unsigned()->index();
            $table->foreign('provider_id')->references('id')->on('providers')->onDelete('cascade');
            $table->timestamps();
            $table->tinyInteger('archived')->default(0);
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
        Schema::drop('resource_user');
        Schema::drop('resources');
    }
}
