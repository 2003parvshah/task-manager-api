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
        Schema::create('session_logs', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->uuid('user_id'); // UUID format for user_id (since you use UUID in registration)
            $table->string('event'); // login/register/logout
            $table->ipAddress('ip_address')->nullable(); // IP Address
            $table->text('user_agent')->nullable(); // Browser info
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('session_logs');
    }
};
