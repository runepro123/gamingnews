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
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('display_name');
            $table->string('code');
            $table->text('flag'); 
            $table->tinyInteger('is_rtl')->nullable()->comment('0: No (LTR), 1: Yes (RTL)');
            $table->unsignedTinyInteger('status')->default(0)->nullable()->comment('0: active, 1: inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('languages');
    }
};
