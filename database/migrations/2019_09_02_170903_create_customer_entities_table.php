<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerEntitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_entities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->integer('total_quantity')->nullable();
            $table->integer('rate')->nullable();
            $table->integer('price')->nullable();
            $table->string('ms_rod')->nullable();
            $table->string('payment_type')->nullable();
            $table->integer('total_price')->nullable();
            $table->integer('commission')->nullable();
            $table->string('comment')->nullable();
            $table->string('source')->nullable();
            $table->integer('credit');
            $table->integer('debit');
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
        Schema::dropIfExists('customer_entities');
    }
}
