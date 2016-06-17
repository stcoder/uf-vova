<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableHistoryEventsAddColumnMore extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('history_events', function(Blueprint $table) {
			$table->boolean('more')->after('date_event')->defualt(false);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('history_events', function(Blueprint $table) {
			$table->dropColumn('more');
		});
	}

}
