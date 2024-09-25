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
            $table->string('codePromo')->unique(); // Le code promo
            $table->integer('pourcentage_reduction'); // Le pourcentage de réduction
            $table->unsignedBigInteger('category_id')->nullable();

            // Relation avec les catégories
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->timestamps();
        });

        // Création de la table pivot entre promotions et produits
        Schema::create('promotion_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('promotion_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Suppression de la table pivot
        Schema::dropIfExists('promotion_product');
        // Suppression de la table promotions
        Schema::dropIfExists('promotions');
    }
};
