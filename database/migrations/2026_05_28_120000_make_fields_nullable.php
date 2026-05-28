<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('industries', function (Blueprint $table) {
            $table->string('image')->nullable()->change();
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->string('short_form')->nullable()->change();
            $table->text('description')->nullable()->change();
            $table->string('list_img')->nullable()->change();
            $table->string('detail_img')->nullable()->change();
        });

        Schema::table('sub_categories', function (Blueprint $table) {
            $table->string('short_form')->nullable()->change();
            $table->text('description')->nullable()->change();
            $table->string('list_img')->nullable()->change();
            $table->string('detail_img')->nullable()->change();
        });

        Schema::table('faqs', function (Blueprint $table) {
            $table->json('faq_items')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('industries', function (Blueprint $table) {
            $table->string('image')->nullable(false)->change();
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->string('short_form')->nullable(false)->change();
            $table->text('description')->nullable(false)->change();
            $table->string('list_img')->nullable(false)->change();
            $table->string('detail_img')->nullable(false)->change();
        });

        Schema::table('sub_categories', function (Blueprint $table) {
            $table->string('short_form')->nullable(false)->change();
            $table->text('description')->nullable(false)->change();
            $table->string('list_img')->nullable(false)->change();
            $table->string('detail_img')->nullable(false)->change();
        });

        Schema::table('faqs', function (Blueprint $table) {
            $table->json('faq_items')->nullable(false)->change();
        });
    }
};
