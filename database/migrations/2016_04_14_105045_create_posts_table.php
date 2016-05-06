<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('external_id')->index();
			$table->dateTime('date');
			$table->text('text');
			$table->softDeletes();
			$table->timestamps();
		});

		Schema::create('attachment_post', function(Blueprint $table) {
			$table->increments('id');

			$table->integer('post_id')->unsigned()->index();
			$table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');

			$table->integer('attachment_id')->unsigned()->index();
			$table->foreign('attachment_id')->references('id')->on('attachments')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('attachment_post', function(Blueprint $table) {
			$table->dropForeign('attachment_post_post_id_foreign');
			$table->dropForeign('attachment_post_attachment_id_foreign');
		});
		Schema::dropIfExists('attachment_post');
		Schema::dropIfExists('posts');
	}

}
