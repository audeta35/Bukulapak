<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('users_id');

            $table->string('buyer_name');
            $table->string('buyer_email');
            $table->text('buyer_address');
            $table->string('buyer_city');
            $table->string('buyer_province');
            $table->integer('postal_code');

            $table->string('account');
            $table->string('account_name');
            $table->string('account_bank');

            $table->string('product');
            $table->integer('product_weight');
            $table->integer('product_total');
            $table->integer('product_value');

            $table->string('courier_name');
            $table->string('courier_service');
            $table->string('courier_etd');
            $table->integer('courier_value');

            $table->integer('additional_cost');
            $table->integer('total_bill');
            $table->string('status');

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
        Schema::dropIfExists('invoices');
    }
}
