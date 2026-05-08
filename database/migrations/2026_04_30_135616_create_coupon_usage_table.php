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
        Schema::create('coupon_usage', function (Blueprint $table) {
            $table->id();

            $table->string('session_id')->nullable();
            $table->string('client_ip')->nullable();
            $table->string('client_fingerprint')->nullable()->comment('Hash unique du client');

            $table->timestamps();

            $table->foreignId('promotion_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('order_id')->nullable()->constrained()->onDelete('cascade');

            $table->index(['promotion_id', 'client_fingerprint']);
            $table->index(['promotion_id', 'session_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupon_usage');
    }
};
