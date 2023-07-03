<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_out', function (Blueprint $table) {
            $table->id();
            $table->integer('tran_id');
            $table->integer('brand_id');
            $table->string('product_id');
            $table->integer('capacity_id');
            // $table->integer('type_id');
            $table->integer('qty');
            $table->integer('price');
            $table->integer('discount_per')->nullable();
            $table->integer('discount_amt')->nullable();
            $table->integer('total_price')->nullable();
            $table->tinyInteger('created_by')->nullable();
            $table->tinyInteger('updated_by')->nullable();
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
        Schema::dropIfExists('stock_out');
    }
};
