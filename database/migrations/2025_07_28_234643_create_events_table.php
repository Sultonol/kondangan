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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('groom_name');
            $table->string('bride_name');
            $table->datetime('event_date');
            $table->string('location');
            $table->string('dress_code_image')->nullable();
            $table->json('schedule'); // JSON untuk menyimpan jadwal acara
            $table->string('bank_name');
            $table->string('account_number');
            $table->string('account_holder');
            $table->string('invitation_code')->unique();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
