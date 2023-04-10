<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.  public function up(): void
     */
    public function up()
    {
        Schema::create('category_product', function (Blueprint $table) {
            $table->integer('category_id')->unique();
            $table->integer('product_id')->unique();

            // $table->foreign('category_id')->references('id')->on('categories');
            // $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_product');
    }
};
