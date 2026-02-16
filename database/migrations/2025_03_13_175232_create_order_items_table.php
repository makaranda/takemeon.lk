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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->string('item_code');
            $table->decimal('amount', 10, 2);
            $table->integer('qty')->default(1);
            $table->decimal('total', 10, 2);
            $table->enum('status', ['pending', 'shipped', 'delivered', 'returned'])->default('pending');
            $table->timestamps();

            // Foreign Key Constraint
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
