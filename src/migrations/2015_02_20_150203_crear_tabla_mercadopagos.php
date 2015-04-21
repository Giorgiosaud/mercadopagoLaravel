<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaMercadopagos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mercadopagos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('idMercadoPago')->index()->unsigned();
			$table->string('site_id');
			$table->string('operation_type');
			$table->string('order_id');
			$table->integer('external_reference')->unsigned();
			$table->string('status');
			$table->string('status_detail');
			$table->string('payment_type');
			$table->string('date_created');
			$table->string('last_modified');
			$table->string('date_approved');
			$table->string('money_release_date');
			$table->string('currency_id');
			$table->float('transaction_amount');
			$table->string('shipping_cost');
			$table->float('finance_charge')->nullable();
			$table->float('total_paid_amount');
			$table->float('net_received_amount');
			$table->string('reason');
			$table->string('payerId');
			$table->string('payerfirst_name');
			$table->string('payerlast_name');
			$table->string('payeremail');
			$table->string('payernickname');
			$table->string('phonearea_code');
			$table->string('phonenumber');
			$table->string('phoneextension')->nullable();
			$table->string('collectorid');
			$table->string('collectorfirst_name');
			$table->string('collectorlast_name');
			$table->string('collectoremail');
			$table->string('collectornickname');
			$table->string('collectorphonearea_code');
			$table->string('collectorphonenumber');
			$table->string('collectorphoneextension')->nullable();
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
		Schema::drop('mercadopagos');
	}

}
