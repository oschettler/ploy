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
		    /*
		     * @see https://laracasts.com/discuss/channels/general-discussion/l5-migration-issue
		    $table->string('update_script')->nullable()->change();	
            $table->string('owner_name', 100)->nullable()->change();
            $table->string('owner_email', 100)->nullable()->change();
			*/
		    DB::statement('ALTER TABLE `repos` MODIFY `update_script` TEXT NULL;');
		    DB::statement('ALTER TABLE `repos` MODIFY `owner_name` VARCHAR(100) NULL;');
		    DB::statement('ALTER TABLE `repos` MODIFY `owner_email` VARCHAR(100) NULL;');
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
