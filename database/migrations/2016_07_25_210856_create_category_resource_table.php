<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryResourceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_resource', function (Blueprint $table) {
            $table->integer('resource_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->foreign('resource_id')->references('Id')->on('resource');
            $table->foreign('category_id')->references('Id')->on('category');
            $table->primary(['resource_id', 'category_id']);
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