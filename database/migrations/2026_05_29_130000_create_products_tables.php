<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name')->nullable();
            $table->string('product_modal')->nullable();
            $table->string('datasheet')->nullable();
            $table->text('description')->nullable();
            $table->text('features')->nullable();
            $table->string('list_image')->nullable();
            $table->text('detail_images')->nullable();
            $table->timestamps();
        });

        Schema::create('product_technical_specifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->string('parameter')->nullable();
            $table->string('specifications')->nullable();
            $table->boolean('is_show_on_list')->nullable();
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_technical_specifications');
        Schema::dropIfExists('products');
    }
};
