<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBacgroundcolorcolumnToCalendareventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('calendar_events', function(Blueprint $table)
        {
            $table->string('backgroundcolor')->nullable();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('calendar_events', function(Blueprint $table)
        {
            // delete above columns
            $table->dropColumn(array('backgroundcolor'));
        });
	}

}
