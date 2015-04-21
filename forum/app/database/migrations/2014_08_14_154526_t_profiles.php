<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TProfiles extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_profiles', function($t) {
            $t->increments('id');
            $t->integer('user_id');
            $t->string('job');
            $t->string('city');
            $t->string('about');
            $t->boolean('job_public')->default(1);
            $t->boolean('city_public')->default(1);
            $t->boolean('about_public')->default(1);
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('t_profiles');
    }

}
