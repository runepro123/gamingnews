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
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('language_id');
            $table->foreign('language_id')->references('id')->on('languages');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->string('title');
            $table->integer('content_type')->comment('1: standard post, 2: video (youtube), 3: video (other url), 4: video (upload)');
            $table->text('youtube_url')->nullable();
            $table->text('other_url')->nullable();
            $table->text('video')->nullable();
            $table->text('image'); 
            $table->longText('description'); 
            $table->integer('favorite_count')->default(0);
            $table->integer('total_views');
            $table->unsignedTinyInteger('status')->default(0)->nullable()->comment('0: active, 1: inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};
