<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TSettings extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_settings', function($t) {
            $t->increments('id');
            $t->string('title');
            $t->string('description');
            $t->string('keywords');
            $t->string('max_pic_upload_size');
            $t->boolean('acc_activation');
            $t->boolean('tos');
            $t->string('theme')->default("forumium");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('t_settings');
    }

}
