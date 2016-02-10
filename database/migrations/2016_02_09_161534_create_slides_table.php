<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlidesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('slides', function(Blueprint $table) {
			$table->engine = 'InnoDB';

			$table->increments('id');
			$table->integer('page_id')->unsigned();
			$table->string('title')->nullable();
			$table->text('description')->nullable();
			$table->string('image')->nullable();
			$table->integer('sort')->default(0);

			$table->foreign('page_id')->references('id')->on('pages');
			$table->softDeletes();
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
		Schema::dropIfExists('slides');
	}

}
