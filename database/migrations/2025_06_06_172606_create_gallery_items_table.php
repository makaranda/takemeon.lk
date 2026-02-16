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
        Schema::create('gallery_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gallery_id')
                  ->constrained('galleries')->cascadeOnDelete();
            $table->string('feature_image')->nullable();
            $table->string('link')->nullable();
            $table->string('video_image')->nullable();
            $table->text('video')->nullable();
            $table->string('route_name')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('status')->default(1);
            $table->foreignId('author_id')->nullable()
                  ->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gallery_items');
    }
};
