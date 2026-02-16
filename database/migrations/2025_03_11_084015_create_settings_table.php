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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('main_logo')->default('logo.png');
            $table->string('fevicon_logo')->default('fevicon.png');
            $table->string('website_title');
            $table->string('contact_number');
            $table->string('email_address');
            $table->text('address');
            $table->text('google_map');
            $table->string('social_facebook');
            $table->string('social_twitter');
            $table->string('social_youtube');
            $table->string('social_instagram');
            $table->text('footer_content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
