<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('total_quantity');
            $table->integer('rate');
            $table->integer('price');
            $table->string('brand');
            $table->string('due_no')->nullable();
            $table->integer('customer_id')->nullable();
            $table->integer('paid_money')->nullable();
            $table->integer('due_money')->nullable();
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
        Schema::dropIfExists('cements');
    }
}
