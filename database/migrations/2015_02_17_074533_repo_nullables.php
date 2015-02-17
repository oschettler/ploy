<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RepoNullables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('repos', function(Blueprint $table)
		{
		    $table->string('update_script', 50)->nullable()->change();	
            $table->string('owner_name', 100)->nullable()->change();
            $table->string('owner_email', 100)->nullable()->change();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('repos', function(Blueprint $table)
		{
			//
		});
	}

}
