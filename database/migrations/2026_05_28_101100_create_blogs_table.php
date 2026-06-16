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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->longText('short_description')->nullable();
            $table->longText('detail_description')->nullable();
            $table->text('conclusion')->nullable();
            $table->string('url')->nullable();
            $table->date('date')->nullable();
            $table->string('front_image')->nullable();
            $table->string('detail_image')->nullable();
            $table->string('cta_image')->nullable();
            $table->string('front_image_alt')->nullable();
            $table->string('detail_image_alt');
            $table->string('cta_image_alt')->nullable();
            $table->longText('schema_json')->nullable();
            $table->string('cta_link_url')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->enum('status', ['Active', 'In-Active']);
            $table->longText('blog_faq')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
