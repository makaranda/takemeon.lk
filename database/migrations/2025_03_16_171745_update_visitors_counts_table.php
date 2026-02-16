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
        Schema::table('visitors_counts', function (Blueprint $table) {
            $table->dropForeign(['page_id']); // Remove foreign key if it exists
            $table->dropColumn('page_id'); // Drop page_id column
            $table->string('route_name')->after('id'); // Add route_name column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visitors_counts', function (Blueprint $table) {
            $table->bigInteger('page_id')->unsigned()->after('id');
            // If you had a foreign key, you can add it back:
            // $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
            $table->dropColumn('route_name');
        });
    }
};
