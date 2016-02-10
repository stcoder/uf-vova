<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pages', function(Blueprint $table) {
			$table->engine = 'InnoDB';

			$table->increments('id');
			$table->integer('admin_id')->unsigned();
			$table->string('title')->nullable();
			$table->string('slug')->nullable()->index();
			$table->longText('content')->nullable();
			$table->text('meta_keywords')->nullable();
			$table->text('meta_description')->nullable();
			$table->text('meta_others')->nullable();
			$table->boolean('published')->default(false);

			$table->foreign('admin_id')->references('id')->on('administrators');
			$table->timestamp('published_at');
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
		Schema::dropIfExists('pages');
	}

}
