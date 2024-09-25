<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Promotion extends Model
{
    use HasFactory;
    protected $fillable = ['codePromo', 'pourcentage_reduction', 'category_id'];

    // Relation avec une seule catégorie
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relation avec plusieurs produits
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_promotion');
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
