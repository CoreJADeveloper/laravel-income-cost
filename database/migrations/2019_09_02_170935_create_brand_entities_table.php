<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandEntitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brand_entities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('brand_id')->unsigned();
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->string('due_no')->nullable();
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
        Schema::dropIfExists('brand_entities');
    }
}
