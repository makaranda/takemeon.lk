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
        Schema::rename('application_forms', 'links');

        // Modify columns
        Schema::table('links', function (Blueprint $table) {
            $table->string('file_name')->nullable()->change();

            $table->string('link')->default('#')->after('file_name');
            $table->string('icon')->nullable()->after('link');
            $table->string('image')->nullable()->after('icon');
            $table->string('type')->default('link')->after('image');

            $table->integer('order')->default(0)->change();
            $table->boolean('status')->default(1)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('links', function (Blueprint $table) {
            $table->string('file_name')->nullable(false)->change();
            $table->dropColumn(['link', 'icon', 'image','type']);
            $table->integer('order')->default(null)->change();
            $table->boolean('status')->default(null)->change();
        });

        Schema::rename('links', 'application_forms');
    }
};
