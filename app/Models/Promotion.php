<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Promotion extends Model
{
    use HasFactory;
    protected $fillable = ['codePromo', 'pourcentage_reduction'];

    // Génération automatique du code promo
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($promotion) {
            $promotion->codePromo = 'CPFPROMO-' . strtoupper(Str::random(8)); // Générer un code promo unique
        });
    }
}
