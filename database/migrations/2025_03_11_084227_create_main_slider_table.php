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
        Schema::create('main_slider', function (Blueprint $table) {
            $table->id();
            $table->string('banner')->default('main_banner.jpg');
            $table->string('heading')->default('Website Name');
            $table->string('sub_heading')->default('Website Short Description');
            $table->boolean('switch')->default(0);
            $table->boolean('music_area_switch')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('main_slider');
    }
};
