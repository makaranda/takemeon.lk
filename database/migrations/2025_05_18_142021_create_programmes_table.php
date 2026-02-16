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
        Schema::create('programmes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('sub_description')->nullable();
            $table->string('feature_image')->nullable();
            $table->string('category');
            $table->string('sub_category');
            $table->string('country')->nullable();
            $table->string('slug');
            $table->string('route_name')->nullable();
            $table->text('seo_keywords')->nullable();
            $table->text('seo_description')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('status')->default(1);
            $table->unsignedBigInteger('author_id')->nullable();
            $table->timestamps();

            // Optional foreign key constraint
            // $table->foreign('according_id')->references('id')->on('accordings')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programmes');
    }
};
