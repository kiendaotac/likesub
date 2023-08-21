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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id')->nullable();
            $table->string('order_id', 50)->unique();
            $table->bigInteger('service_id')->nullable();
            $table->string('service');
            $table->string('target_identify');
            $table->integer('target');
            $table->integer('original');
            $table->json('extra_data')->nullable();
            $table->json('response_data')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
