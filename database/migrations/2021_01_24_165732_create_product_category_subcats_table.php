<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCategorySubcatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_category_subcats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subcategory_id')->nullable()->constrained('sub_categories');
            $table->foreignId('category_id')->nullable()->constrained('categories');
            $table->foreignId('product_id')->constrained('products');
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
        Schema::dropIfExists('product_category_subcats');
    }
}
