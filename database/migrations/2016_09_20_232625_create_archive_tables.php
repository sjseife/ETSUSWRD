<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchiveTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_archive', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role');
            $table->rememberToken();
            $table->timestamps();
            $table->timestamp('archived_at');
        });

        Schema::create('resources_archive', function (Blueprint $table) {
            $table->integer('id')->unsigned();
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
            $table->timestamp('archived_at');
        });

        Schema::create('categories_archive', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->string('name', 150);
            $table->timestamps();
            $table->timestamp('archived_at');
        });

        Schema::create('category_resource_archive', function (Blueprint $table) {
            $table->integer('category_id')->unsigned();
            $table->integer('resource_id')->unsigned();
            $table->timestamps();
            $table->timestamp('archived_at');
        });

        Schema::create('contacts_archive', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->string('firstName', 25);
            $table->string('lastName', 30);
            $table->string('email')->unique();
            $table->string('phoneNumber', 15);
            $table->timestamps();
            $table->timestamp('archived_at');
        });

        Schema::create('contact_resource_archive', function (Blueprint $table) {
            $table->integer('contact_id')->unsigned();
            $table->integer('resource_id')->unsigned();
            $table->timestamps();
            $table->timestamp('archived_at');
        });

        Schema::create('flags_archive', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->string('level');
            $table->text('comments');
            $table->boolean('resolved');
            $table->integer('submitted_by')
                ->unsigned()
                ->default(NULL);
            $table->integer('user_id')
                ->unsigned()
                ->nullable();
            $table->integer('resource_id')
                ->unsigned()
                ->nullable();
            $table->integer('contact_id')
                ->unsigned()
                ->nullable();
            $table->timestamps();
            $table->timestamp('archived_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users_archive');
        Schema::drop('resources_archive');
        Schema::drop('categories_archive');
        Schema::drop('category_resource_archive');
        Schema::drop('contacts_archive');
        Schema::drop('contact_resource_archive');
        Schema::drop('flags_archive');
    }
}
