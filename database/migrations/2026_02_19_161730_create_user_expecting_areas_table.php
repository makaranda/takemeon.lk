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
        Schema::create('user_expecting_areas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');

            $table->string('job_industry')->nullable();
            $table->string('job_type')->nullable();
            $table->string('job_role')->nullable();
            $table->string('designation')->nullable();
            $table->decimal('expected_salary', 12, 2)->nullable();

            $table->timestamps();

            // Foreign key
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            // If one user should have only one expectation record
            $table->unique('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_expecting_areas');
    }
};
