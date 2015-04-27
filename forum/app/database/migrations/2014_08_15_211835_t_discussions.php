<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TDiscussions extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_discussions', function($table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->integer('views');
            $table->integer('cat_id');
            $table->integer('by_id');
            $table->boolean('hot');
            $table->boolean('closed');
            $table->string('type');
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
        Schema::drop('t_discussions');
    }

}
