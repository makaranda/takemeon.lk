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
        Schema::table('settings', function (Blueprint $table) {
            $table->string('website_name')->nullable()->change();
            $table->string('main_logo')->nullable()->change();
            $table->string('fevicon_logo')->nullable()->change();
            $table->string('website_title')->nullable()->change();
            $table->string('contact_number')->nullable()->change();
            $table->string('email_address')->nullable()->change();
            $table->text('address')->nullable()->change();
            $table->text('google_map')->nullable()->change();
            $table->string('social_facebook')->nullable()->change();
            $table->string('social_twitter')->nullable()->change();
            $table->string('social_youtube')->nullable()->change();
            $table->string('social_instagram')->nullable()->change();
            $table->text('footer_content')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('website_name')->nullable(false)->change();
            $table->string('main_logo')->nullable(false)->change();
            $table->string('fevicon_logo')->nullable(false)->change();
            $table->string('website_title')->nullable(false)->change();
            $table->string('contact_number')->nullable(false)->change();
            $table->string('email_address')->nullable(false)->change();
            $table->text('address')->nullable(false)->change();
            $table->text('google_map')->nullable(false)->change();
            $table->string('social_facebook')->nullable(false)->change();
            $table->string('social_twitter')->nullable(false)->change();
            $table->string('social_youtube')->nullable(false)->change();
            $table->string('social_instagram')->nullable(false)->change();
            $table->text('footer_content')->nullable(false)->change();
        });
    }
};
