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
            $table->string('switch_title')->after('switch')->nullable();
            $table->string('switch_link')->after('switch_title')->nullable();
            $table->integer('status')->after('switch_link')->default(1);
            $table->dropColumn('music_area_switch');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('main_slider', function (Blueprint $table) {
            $table->dropColumn('switch_title');
            $table->dropColumn('switch_link');
            $table->dropColumn('status');
            $table->integer('music_area_switch')->after('switch')->default(1);
        });
    }
};
