<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TBans extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_bans', function($t) {
            $t->increments('id');
            $t->boolean('BannedIp');
            $t->boolean('BannedUser');
            $t->integer('user_id');
            $t->string('ip');
            $t->integer('ban_from');
            $t->integer('ban_to');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('t_bans');
    }

}
