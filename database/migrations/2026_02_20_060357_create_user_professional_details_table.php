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
        Schema::create('user_professional_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');

            $table->integer('total_years_experience')->nullable();
            $table->text('skills_summary')->nullable();
            $table->text('about_yourself')->nullable();

            $table->string('current_employer')->nullable();
            $table->string('current_industry')->nullable();
            $table->string('current_business_function')->nullable();
            $table->string('designation')->nullable();

            $table->date('started_in')->nullable();
            $table->integer('notice_period_days')->nullable();

            $table->text('about_current_role')->nullable();
            $table->decimal('current_salary', 12, 2)->nullable();

            // File paths
            $table->string('cv_file')->nullable();
            $table->string('nic_front')->nullable();
            $table->string('nic_back')->nullable();

            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_professional_details');
    }
};
