<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('title');
            $table->string('sub_category_url')->nullable();
            $table->string('short_form')->nullable();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->string('catalogue_pdf')->nullable();
            $table->string('list_img')->nullable();
            $table->string('detail_img')->nullable();
            $table->string('cta_img')->nullable();
            $table->string('cta_img_title')->nullable();
            $table->text('cta_img_description')->nullable();
            $table->json('cta_icon')->nullable();
            $table->json('cta_title')->nullable();
            $table->json('cta_description')->nullable();
            $table->json('faqs')->nullable();
            $table->string('faq_title')->nullable();
            $table->text('faq_description')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description', 500)->nullable();
            $table->boolean('is_active')->nullable()->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sub_categories');
    }
};
