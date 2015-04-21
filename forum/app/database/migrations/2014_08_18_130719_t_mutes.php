<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TMutes extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_mutes', function($t) {
            $t->increments('id');
            $t->integer('user_id');
            $t->integer('muted_from');
            $t->integer('muted_to');
            $t->string('reason');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('t_mutes');
    }

}
