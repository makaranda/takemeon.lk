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
        Schema::table('user_past_employments', function (Blueprint $table) {

            // Drop old string columns
            $table->dropColumn(['role', 'employee_category', 'industry']);
        });

        Schema::table('user_past_employments', function (Blueprint $table) {

            // Add new foreign key columns
            $table->unsignedBigInteger('role')->after('company_name');
            $table->unsignedBigInteger('employee_category')->after('role');
            $table->unsignedBigInteger('industry')->nullable()->after('employee_category');

            // Add Foreign Keys
            $table->foreign('role')
                ->references('id')
                ->on('emp_designations')
                ->onDelete('cascade');

            $table->foreign('employee_category')
                ->references('id')
                ->on('emp_main_categories')
                ->onDelete('cascade');

            $table->foreign('industry')
                ->references('id')
                ->on('emp_industries')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_past_employments', function (Blueprint $table) {

            // Drop foreign keys
            $table->dropForeign(['role']);
            $table->dropForeign(['employee_category']);
            $table->dropForeign(['industry']);

            // Drop columns
            $table->dropColumn(['role', 'employee_category', 'industry']);
        });

        Schema::table('user_past_employments', function (Blueprint $table) {

            // Recreate as string columns (rollback safety)
            $table->string('role');
            $table->string('employee_category');
            $table->string('industry')->nullable();
        });
    }
};
