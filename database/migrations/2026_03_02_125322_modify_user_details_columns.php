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
        Schema::table('user_details', function (Blueprint $table) {
            $table->string('address')->nullable()->change();
            $table->date('dob')->nullable()->change();
            $table->string('nic')->nullable()->change();
            
            $table->string('profile_img')
                  ->default('user_profile.png')
                  ->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_details', function (Blueprint $table) {
            $table->string('address')->nullable(false)->change();
            $table->date('dob')->nullable(false)->change();
            $table->string('nic')->nullable(false)->change();
            
            $table->string('profile_img')
                  ->default(null)
                  ->change();
        });
    }
};
