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
        Schema::table('sections', function (Blueprint $table) {
            // Ajouter la colonne image
            $table->string('image')->nullable()->after('slug');

            // Modifier description en longText
            $table->longText('description')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sections', function (Blueprint $table) {
            // Supprimer la colonne image
            $table->dropColumn('image');

            // Remettre description en text
            $table->text('description')->nullable()->change();
        });
    }
};
