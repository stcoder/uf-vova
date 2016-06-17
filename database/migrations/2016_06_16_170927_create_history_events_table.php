<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('history_events', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('history_date_id')->unsigned()->index();
			$table->string('title');
			$table->text('description');
			$table->text('image');
			$table->dateTime('date_event');
			$table->softDeletes();
			$table->timestamps();

			$table->foreign('history_date_id')->references('id')->on('history_dates')->onDelete('cascade');
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
			$table->dropForeign('history_events_history_date_id_foreign');
		});
		Schema::drop('history_events');
	}

}
