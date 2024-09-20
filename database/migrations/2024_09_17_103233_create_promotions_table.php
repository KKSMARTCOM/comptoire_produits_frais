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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            // $table->string('codePromo')->unique(); 
            // $table->string('codePromo')->nullable()->unique()->change(); // Le code promo
            $table->string('codePromo')->unique(); // Le code promo
            $table->integer('pourcentage_reduction'); // Le pourcentage de réduction
            $table->unsignedBigInteger('category_id')->nullable();
$table->unsignedBigInteger('product_id')->nullable();

$table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
$table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};