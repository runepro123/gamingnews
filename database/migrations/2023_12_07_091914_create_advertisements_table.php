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
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->string('admob_inter')->nullable();
            $table->string('admob_banner')->nullable();
            $table->string('admob_native')->nullable();
            $table->string('admob_reward')->nullable();
            $table->string('admob_open_ads')->nullable();
            $table->string('ios_inter')->nullable();
            $table->string('ios_banner')->nullable();
            $table->string('ios_native')->nullable();
            $table->string('ios_reward')->nullable();
            $table->string('ios_open_ads')->nullable();
            $table->string('facebook_inter')->nullable();
            $table->string('facebook_banner')->nullable();
            $table->string('facebook_native')->nullable();
            $table->string('facebook_reward')->nullable();
            $table->string('unity_appId_gameId')->nullable();
            $table->string('iron_appKey')->nullable();
            $table->string('appnext_placementId')->nullable();
            $table->string('startapp_appId')->nullable();
            $table->string('industrial_interval')->nullable();
            $table->string('native_ads')->nullable();          
            $table->string('ads_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertisements');
    }
};
