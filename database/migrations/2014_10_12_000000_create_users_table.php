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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique()->nullable();
            $table->string('name')->unique()->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('otp_secret')->nullable();
            $table->text('bio')->nullable();
            $table->string('country')->nullable();
            $table->text('profile_image')->nullable();
            $table->unsignedTinyInteger('status')->default(0)->nullable()->comment('0: active, 1: inactive');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
