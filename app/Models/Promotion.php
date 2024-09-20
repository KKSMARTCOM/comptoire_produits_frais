<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Promotion extends Model
{
    use HasFactory;
    protected $fillable = ['codePromo', 'pourcentage_reduction', 'category_id', 'product_id'];

    // Relation avec une seule catégorie
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relation avec un seul produit
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Génération automatique du code promo
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($promotion) {
            if (!$promotion->codePromo) {
                $promotion->codePromo = 'CPFPROMO-' . strtoupper(Str::random(8));
            }
        });
    }
}
