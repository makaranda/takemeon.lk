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
        Schema::table('gallery_home', function (Blueprint $table) {
            $table->tinyInteger('status')->after('image_name')->default(1)->comment('1=Active, 0=Inactive');
            $table->integer('order')->after('status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gallery_home', function (Blueprint $table) {
            $table->dropColumn(['status', 'order']);
        });
    }
};
