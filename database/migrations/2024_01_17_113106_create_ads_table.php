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
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->text('header_ad_img');
            $table->string('header_ad_link');
            $table->text('banner_ad_img');
            $table->string('banner_ad_link');
            $table->text('card_ad_img');
            $table->string('card_ad_link');
            $table->text('sidebar_ad_img');
            $table->string('sidebar_ad_link');
            $table->text('footer_top_ad_img');
            $table->string('footer_top_ad_link');
            $table->text('footer_ad_img');
            $table->string('footer_ad_link');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads');
    }
};
