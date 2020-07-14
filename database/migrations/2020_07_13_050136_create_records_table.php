<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('records', function (Blueprint $table) {
			$table->id();
			$table->integer('wallet_id')->unsigned();
			$table->integer('amount');
			$table->integer('type')->default(0); // 0 = debit 1 = credit
			$table->timestamps();

			$table->foreign('wallet_id')
				->references('id')
				->on('wallets')
				->onUpdate('RESTRICT')
				->onDelete('RESTRICT');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('records');
	}
}
