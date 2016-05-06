<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ParentAttachToChildAttach extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attachment_from_attachment', function(Blueprint $table) {
			$table->increments('id');

			$table->integer('parent_attachment_id')->unsigned()->index();
			$table->foreign('parent_attachment_id')->references('id')->on('attachments')->onDelete('cascade');

			$table->integer('child_attachment_id')->unsigned()->index();
			$table->foreign('child_attachment_id')->references('id')->on('attachments')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('attachment_from_attachment', function(Blueprint $table) {
			$table->dropForeign('attachment_from_attachment_parent_attachment_id_foreign');
			$table->dropForeign('attachment_from_attachment_child_attachment_id_foreign');
		});
		Schema::drop('attachment_from_attachment');
	}

}
