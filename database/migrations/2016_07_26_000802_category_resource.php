<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CategoryResource extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_resource', function (Blueprint $table) {
            $table->integer('category_id')->unsigned()->index();
            $table->integer('resource_id')->unsigned()->index();

            $table->foreign('category_id')->references('Id')->on('category')->onDelete('cascade');
            $table->foreign('resource_id')->references('Id')->on('resource')->onDelete('cascade');

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
        Schema::drop('category_resource');
    }
}
