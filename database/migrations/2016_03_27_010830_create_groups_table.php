<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('groups', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('chaperone_email')->unique()->nullable();
			$table->timestamps();
		});

		Schema::table('users', function (Blueprint $table) {
			$table->integer('group_id')->nullable();
			$table->foreign('group_id')->references('id')->on('groups');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('groups');
		Schema::table('users', function (Blueprint $table) {
			$table->dropColumn('group_id');
		});
	}

}
