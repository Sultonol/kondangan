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
        Schema::table('events', function (Blueprint $table) {
            // Remove columns that will be moved to separate tables
            $table->dropColumn(['schedule', 'bank_name', 'account_number', 'account_holder']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->json('schedule');
            $table->string('bank_name');
            $table->string('account_number');
            $table->string('account_holder');
        });
    }
};
