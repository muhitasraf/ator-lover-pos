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
        Schema::create('tran_master', function (Blueprint $table) {
            $table->id();
            $table->string('tran_id');
            $table->integer('total_qty');
            $table->integer('discount_per')->nullable();
            $table->double('total_discount')->nullable();
            $table->double('grand_total')->nullable();
            $table->date('tran_date')->nullable();
            $table->integer('tran_type')->nullable();
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
        Schema::dropIfExists('tran_master');
    }
};
