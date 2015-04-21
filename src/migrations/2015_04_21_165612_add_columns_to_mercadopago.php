<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToMercadopago extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('mercadopagos', function(Blueprint $table)
		{
			$table->text('identificationType');
            $table->text('identificationNumber');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('mercadopagos', function(Blueprint $table)
		{
			//
		});
	}

}
