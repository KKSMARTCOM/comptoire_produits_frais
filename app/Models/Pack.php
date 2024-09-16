<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pack extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'status',
    ];

    // Relation avec les produits
    public function products()
    {
        return $this->belongsToMany(Product::class, 'pack_product')->withPivot('quantity');
    }
}
