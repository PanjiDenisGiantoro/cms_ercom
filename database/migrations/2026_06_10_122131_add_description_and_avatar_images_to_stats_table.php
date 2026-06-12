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
        Schema::table('stats', function (Blueprint $table) {
            $table->text('description')->nullable()->after('stat_label');
            $table->json('avatar_images')->nullable()->after('description');
            $table->dropColumn('avatar_image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stats', function (Blueprint $table) {
            $table->dropColumn(['description', 'avatar_images']);
            $table->string('avatar_image')->nullable();
        });
    }
};
