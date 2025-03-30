<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phno')->nullable();
            
            // ✅ Email verification fields
            $table->boolean('is_active')->default(false);         // Inactive until verification
            $table->string('verification_token')->nullable();     // Token for email verification
            $table->timestamp('email_verified_at')->nullable();   // Timestamp for when email is verified
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
