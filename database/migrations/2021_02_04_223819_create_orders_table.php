<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_token')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->string('name')->nullable();
            $table->string('user_phone')->nullable();
            $table->string('user_email')->nullable();
            $table->longText('address')->nullable();
            $table->longText("order_notes")->nullable();
            $table->double('total_unitprice')->nullable();
            $table->double('total_actualprice')->nullable();
            $table->double('total_discount')->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('orders');
    }
}
