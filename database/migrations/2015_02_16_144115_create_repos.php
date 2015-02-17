<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (! Schema::hasTable('repos')) {
		Schema::create('repos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 100);
			$table->text('update_script');
			$table->string('ssh_clone_url', 100);
			$table->string('owner_name', 100);
			$table->string('owner_email', 100);
			$table->timestamps();
		});
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('repos');
	}

}
