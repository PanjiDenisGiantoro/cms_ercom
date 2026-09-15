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
        Schema::table('navbar_settings', function (Blueprint $table) {
            $table->text('whatsapp_default_message')->nullable()->after('whatsapp_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('navbar_settings', function (Blueprint $table) {
            $table->dropColumn('whatsapp_default_message');
        });
    }
};
