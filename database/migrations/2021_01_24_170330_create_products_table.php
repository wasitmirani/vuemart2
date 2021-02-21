<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->foreignId('categoryId')->nullable()->constrained('categories');
            $table->foreignId('subcategoryId')->nullable()->constrained('sub_categories');
            $table->string('quantityPerUnit')->nullable();
            $table->double('unitPrice', 8, 2)->nullable();
            $table->double('actualPrice', 8, 2)->nullable();
            $table->integer('unitsInStock')->nullable();
            $table->double('discontinued', 8, 2)->nullable();
            $table->longText('description')->nullable();
            $table->longText('meta_description')->nullable();

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
        Schema::dropIfExists('products');
    }
}
