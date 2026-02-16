<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('programmes', function (Blueprint $table) {
            // Remove foreign key constraint
            $table->dropForeign(['sub_category']);
        });

        Schema::table('programmes', function (Blueprint $table) {
            // Modify column: set unsigned and default 0
            $table->unsignedBigInteger('sub_category')->default(0)->change();
        });

        // Update all existing rows to 0
        DB::table('programmes')->update(['sub_category' => 0]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
          Schema::table('programmes', function (Blueprint $table) {
            // Remove default value
            $table->unsignedBigInteger('sub_category')->nullable()->default(null)->change();

            // Restore foreign key (optional)
            $table->foreign('sub_category')
                ->references('id')
                ->on('program_sub_category_items')
                ->onDelete('cascade');
        });
    }
};
