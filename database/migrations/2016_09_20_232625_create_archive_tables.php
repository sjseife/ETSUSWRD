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
        Schema::create('archive_users', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role');
            $table->timestamps();
            $table->timestamp('archived_at');
        });

        Schema::create('archive_resources', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 150);
            $table->string('streetAddress', 50);
            $table->string('streetAddress2', 25);
            $table->string('city', 40);
            $table->string('county', 15);
            $table->string('state', 2);
            $table->string('zipCode', 5);
            $table->string('publicPhoneNumber', 15)->nullable();
            $table->string('publicEmail')->nullable();
            $table->string('website')->nullable();
            $table->text('description');
            $table->text('comments');
            $table->integer('provider_id')->unsigned();
            $table->timestamps();
            $table->timestamp('archived_at');
        });

        Schema::create('archive_categories', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->string('name', 150);
            $table->timestamps();
            $table->timestamp('archived_at');
        });

        Schema::create('archive_category_resource', function (Blueprint $table) {
            $table->integer('category_id')->unsigned();
            $table->integer('resource_id')->unsigned();
            $table->timestamps();
            $table->timestamp('archived_at');
        });

        Schema::create('archive_category_event', function (Blueprint $table) {
            $table->integer('category_id')->unsigned();
            $table->integer('event_id')->unsigned();
            $table->timestamps();
            $table->timestamp('archived_at');
        });

        Schema::create('archive_contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstName', 25);
            $table->string('lastName', 30);
            $table->string('protectedEmail')->nullable();
            $table->string('protectedPhoneNumber', 15)->nullable();
            $table->timestamps();
            $table->timestamp('archived_at');
        });

        Schema::create('archive_contact_provider', function (Blueprint $table) {
            $table->integer('contact_id')->unsigned();
            $table->integer('provider_id')->unsigned();
            $table->string('title')->nullable();
            $table->timestamps();
            $table->timestamp('archived_at');
        });

        Schema::create('archive_flags', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->string('level');
            $table->text('comments');
            $table->boolean('resolved');
            $table->integer('submitted_by')
                ->unsigned()
                ->nullable();
            $table->integer('user_id')
                ->unsigned()
                ->nullable();
            $table->integer('resource_id')
                ->unsigned()
                ->nullable();
            $table->integer('contact_id')
                ->unsigned()
                ->nullable();
            $table->integer('provider_id')
                ->unsigned()
                ->nullable();
            $table->integer('event_id')
                ->unsigned()
                ->nullable();
            $table->timestamps();
            $table->timestamp('archived_at');
        });

        Schema::create('archive_resource_user', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('resource_id')->unsigned();
            $table->timestamps();
            $table->timestamp('archived_at');
        });

        Schema::create('archive_event_user', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('event_id')->unsigned();
            $table->timestamps();
            $table->timestamp('archived_at');
        });

        Schema::create('archive_events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 150);
            $table->date('startDate');
            $table->date('endDate');
            $table->time('startTime');
            $table->time('endTime');
            $table->string('streetAddress', 50);
            $table->string('streetAddress2', 25);
            $table->string('city', 40);
            $table->string('county', 15);
            $table->string('state', 2);
            $table->string('zipCode', 5);
            $table->string('publicPhoneNumber', 15)->nullable();
            $table->string('publicEmail')->nullable();
            $table->string('website')->nullable();
            $table->text('description');
            $table->text('comments');
            $table->integer('provider_id')->unsigned();
            $table->timestamps();
            $table->timestamp('archived_at');
        });

        Schema::create('archive_providers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 150);
            $table->string('publicPhoneNumber', 15)->nullable();
            $table->string('publicEmail')->nullable();
            $table->string('website')->nullable();
            $table->text('description');
            $table->text('comments');
            $table->timestamps();
            $table->timestamp('archived_at');
        });

        Schema::create('archive_daily_hours', function (Blueprint $table) {
            $table->increments('id');
            $table->string('day');
            $table->time('openTime');
            $table->time('closeTime');
            $table->integer('resource_id')->unsigned()->nullable();
            $table->integer('event_id')->unsigned()->nullable();
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
        Schema::drop('archive_users');
        Schema::drop('archive_resources');
        Schema::drop('archive_categories');
        Schema::drop('archive_category_resource');
        Schema::drop('archive_category_event');
        Schema::drop('archive_contacts');
        Schema::drop('archive_contact_provider');
        Schema::drop('archive_flags');
        Schema::drop('archive_resource_user');
        Schema::drop('archive_event_user');
        Schema::drop('archive_events');
        Schema::drop('archive_providers');
        Schema::drop('archive_daily_hours');
    }
}
