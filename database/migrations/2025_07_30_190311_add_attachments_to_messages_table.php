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
        Schema::table('messages', function (Blueprint $table) {
            $table->string('attachment_type')->nullable()->after('message'); // 'image', 'location', null
            $table->text('attachment_data')->nullable()->after('attachment_type'); // file path or location data
            $table->string('attachment_url')->nullable()->after('attachment_data'); // public URL
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
             $table->dropColumn(['attachment_type', 'attachment_data', 'attachment_url']);
        });
    }
};
