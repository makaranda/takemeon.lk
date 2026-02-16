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
        Schema::table('main_slider', function (Blueprint $table) {
            $table->string('icon')->after('banner')->nullable();
            $table->text('description')->after('sub_heading')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('main_slider', function (Blueprint $table) {
            $table->dropColumn('icon');
            $table->dropColumn('description');
        });
    }
};
