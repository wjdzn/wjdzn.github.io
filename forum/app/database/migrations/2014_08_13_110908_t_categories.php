<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TCategories extends Migration
{

    public function up()
    {
        Schema::create('t_categories', function($table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description', 1000);
            $table->integer('min_membership');
            $table->boolean('must_logged');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('category');
    }

}
