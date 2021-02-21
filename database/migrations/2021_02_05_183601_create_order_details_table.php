<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->nullable()->constrained('orders');
            $table->foreignId('product_id')->nullable()->constrained('products');
            $table->string('name')->nullable();
            $table->integer('qty')->nullable();
            $table->double('units')->nullable();
            $table->double('unitPrice')->nullable();
            $table->double('actualPrice')->nullable();
            $table->double('discount_price')->nullable();


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
        Schema::dropIfExists('order_details');
    }
}
