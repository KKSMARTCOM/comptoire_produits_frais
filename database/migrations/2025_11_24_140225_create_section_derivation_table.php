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
        // TABLE BANNERS (une bannière par section)
        Schema::create('section_banners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')->constrained('sections')->onDelete('cascade');

            $table->string('image');
            $table->string('title')->nullable();
            $table->text('description')->nullable();

            $table->timestamps();
        });

        // TABLE SERVICES (plusieurs services par section)
        Schema::create('section_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')->constrained('sections')->onDelete('cascade');

            $table->string('icon')->nullable();
            $table->string('title');
            $table->text('description')->nullable();

            $table->timestamps();
        });

        // TABLE CATEGORIES (plusieurs catégories par section)
        Schema::create('section_product_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')->constrained()->cascadeOnDelete();
            $table->string('image')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // TABLE ABOUT (a propos par section)
        Schema::create('section_about', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')->constrained()->cascadeOnDelete();
            $table->string('image')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('section_derivation');
    }
};
