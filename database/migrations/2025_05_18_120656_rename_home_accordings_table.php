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
        Schema::rename('home_accordings', 'accordings');
        Schema::table('accordings', function (Blueprint $table) {
            $table->unsignedBigInteger('page_id')->default(0)->after('id');
            $table->string('type')->nullable()->after('sub_topic');
            $table->string('section')->default(1)->after('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('accordings', function (Blueprint $table) {
            $table->dropColumn(['page_id', 'type', 'section']);
        });
        Schema::rename('accordings', 'home_accordings');
    }
};
