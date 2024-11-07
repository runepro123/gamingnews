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
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('app_version')->nullable();
            $table->integer('zoom_control')->nullable();
            $table->string('about_us_url')->nullable();
            $table->string('contact_us_url')->nullable();
            $table->string('privacy_policy_url')->nullable();
            $table->string('terms_and_condition_url')->nullable();
            $table->string('rate_us_url')->nullable();
            $table->string('one_single')->nullable();
            $table->text('privacy_policy')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_settings');
    }
};
