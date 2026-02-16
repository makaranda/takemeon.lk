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
        Schema::table('orders', function (Blueprint $table) {
            // Adding new columns to the orders table
            $table->string('address')->nullable()->after('confirmation');
            $table->string('city')->nullable()->after('address');
            $table->string('district')->nullable()->after('city');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Dropping the address, city, and district columns from the orders table
            $table->dropColumn(['address', 'city', 'district']);
        });
    }
};
