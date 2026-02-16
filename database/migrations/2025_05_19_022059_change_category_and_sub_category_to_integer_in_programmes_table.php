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
        Schema::table('programmes', function (Blueprint $table) {
            $table->unsignedBigInteger('category')->change();
            $table->unsignedBigInteger('sub_category')->change();

            // Then, add foreign key constraints
            $table->foreign('category')
                  ->references('id')
                  ->on('program_categories')
                  ->onDelete('cascade');

            $table->foreign('sub_category')
                  ->references('id')
                  ->on('program_sub_category_items')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('programmes', function (Blueprint $table) {
            $table->dropForeign(['category']);
            $table->dropForeign(['sub_category']);

            // Optionally revert to string if needed
            $table->string('category')->change();
            $table->string('sub_category')->change();
        });
    }
};
