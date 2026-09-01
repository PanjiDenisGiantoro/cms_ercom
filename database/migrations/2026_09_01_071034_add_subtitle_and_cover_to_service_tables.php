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
        Schema::table('service_categories', function (Blueprint $table) {
            $table->string('subtitle')->nullable()->after('name');
        });

        Schema::table('service_items', function (Blueprint $table) {
            $table->string('subtitle')->nullable()->after('name');
            $table->string('cover_image')->nullable()->after('thumbnail');
        });

        Schema::table('service_sub_items', function (Blueprint $table) {
            $table->string('subtitle')->nullable()->after('name');
            $table->string('cover_image')->nullable()->after('thumbnail');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_categories', function (Blueprint $table) {
            $table->dropColumn('subtitle');
        });

        Schema::table('service_items', function (Blueprint $table) {
            $table->dropColumn(['subtitle', 'cover_image']);
        });

        Schema::table('service_sub_items', function (Blueprint $table) {
            $table->dropColumn(['subtitle', 'cover_image']);
        });
    }
};
