<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('contact_inquiries', 'city')) {
            Schema::table('contact_inquiries', function (Blueprint $table) {
                $table->string('city')->nullable()->after('country');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('contact_inquiries', 'city')) {
            Schema::table('contact_inquiries', function (Blueprint $table) {
                $table->dropColumn('city');
            });
        }
    }
};