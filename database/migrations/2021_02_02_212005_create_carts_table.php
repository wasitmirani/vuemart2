<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->nullable()->constrained('products');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->string('session_id')->nullable();
            $table->string('name')->nullable();
            $table->integer('qty')->default(1);
            $table->double('unitPrice')->nullable();
            $table->double('actualPrice')->nullable();
            $table->string('units')->nullable();
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
        Schema::dropIfExists('carts');
    }
}
