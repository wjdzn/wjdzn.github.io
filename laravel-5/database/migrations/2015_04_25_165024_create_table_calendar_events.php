<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCalendarEvents extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('calendar_events', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->string('descripcion');
            $table->timestamp('init_at');
            $table->timestamp('end_at');
            $table->string('link');
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
        Schema::drop('calendar_events');
	}

}
