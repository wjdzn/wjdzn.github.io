<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TUsers extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_users', function($table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('first_name');
            $table->string('surname');
            $table->integer('membership');
            $table->integer('points');
            $table->integer('posts');
            $table->integer('views');
            $table->integer('last_seen');
            $table->string('ip');
            $table->string('country', 3);
            $table->string('access_token');
            $table->boolean('activated');
            $table->string('activation_code', 12);
            $table->string('fb_id');
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
        Schema::drop('t_users');
    }

}
