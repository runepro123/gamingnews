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
        Schema::create('web_configurations', function (Blueprint $table) {
            $table->id();
            $table->string('frontend_api_base_url');
            $table->string('web_app_name');
            $table->string('nav_text_color');
            $table->string('web_color');
            $table->text('header_logo');
            $table->text('footer_logo');
            $table->string('header_contact');
            $table->string('footer_contact');
            $table->text('google_play_app_logo');
            $table->string('google_play_app_link');
            $table->text('app_store_logo');
            $table->string('app_store_link');
            $table->text('footer_description');
            $table->string('footer_address');
            $table->string('copyright');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('web_configurations');
    }
};
