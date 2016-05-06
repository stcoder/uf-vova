<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attachments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('external_id')->index();
			$table->string('access_key')->index();
			$table->enum('type', ['photo', 'audio', 'video', 'doc', 'album']);
			$table->string('title');
			$table->text('description');
			$table->longText('srcs');
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
		Schema::dropIfExists('attachments');
	}

}
