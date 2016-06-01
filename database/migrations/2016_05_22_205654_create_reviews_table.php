<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reviews', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('profile_id')->unsigned()->index();
			$table->string('external_id')->index();
			$table->dateTime('date');
			$table->text('text');
			$table->softDeletes();
			$table->timestamps();

			$table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('reviews', function(Blueprint $table) {
			$table->dropForeign('reviews_profile_id_foreign');
		});
		Schema::drop('reviews');
	}

}
