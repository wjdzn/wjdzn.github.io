<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TMails extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_messages', function($table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('box');
            $table->integer('msg_from');
            $table->integer('msg_to');
            $table->text('msg');
            $table->boolean('read');
            $table->boolean('deleted');
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
        Schema::drop('t_messages');
    }

}
