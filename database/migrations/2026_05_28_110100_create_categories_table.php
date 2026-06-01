<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category_url')->nullable();
            $table->string('short_form')->nullable();
            $table->text('description')->nullable();
            $table->string('catalogue_pdf')->nullable();
            $table->string('list_img')->nullable();
            $table->string('detail_img')->nullable();
            $table->string('cta_img_desktop')->nullable();
            $table->string('cta_img_mobile')->nullable();
            $table->string('cta_img_title')->nullable();
            $table->text('cta_img_description')->nullable();
            $table->json('faqs')->nullable();
            $table->string('faq_title')->nullable();
            $table->text('faq_description')->nullable();
            $table->string('sub_category_heading')->nullable();
            $table->text('sub_category_description')->nullable();
            $table->boolean('is_active')->nullable()->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
