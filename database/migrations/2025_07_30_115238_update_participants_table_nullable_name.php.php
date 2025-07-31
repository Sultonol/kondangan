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
        Schema::table('participants', function (Blueprint $table) {
            // Make name nullable
            $table->string('name')->nullable()->change();
            
            // Add session_id if not exists
            if (!Schema::hasColumn('participants', 'session_id')) {
                $table->string('session_id')->nullable()->after('phone');
                $table->index('session_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('participants', function (Blueprint $table) {
            $table->string('name')->nullable(false)->change();
            
            if (Schema::hasColumn('participants', 'session_id')) {
                $table->dropIndex(['session_id']);
                $table->dropColumn('session_id');
            }
        });
    }
};
