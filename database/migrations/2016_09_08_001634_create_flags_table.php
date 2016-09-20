<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flags', function (Blueprint $table) {
            $table->increments('id');
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


        });

        Schema::table('flags', function(Blueprint $table){
            $table->foreign('submitted_by')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('resource_id')
                ->references('Id')
                ->on('Resources')
                ->onDelete('cascade');
            $table->foreign('contact_id')
                ->references('id')
                ->on('contacts')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('flags');
    }
}
