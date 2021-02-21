<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeoContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo_contents', function (Blueprint $table) {
            $table->id();
            $table->string('page_url')->nullable();
            $table->string('canonical_tag')->nullable();
            $table->longText('page_title')->nullable();
            $table->longText('meta_description')->nullable();
            $table->longText('seo_description')->nullable();
            $table->boolean('status')->default(1);
            $table->longText("questions_json")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seo_contents');
    }
}
