<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{

    use Sluggable;

    protected $fillable = [
        'name',
        'slug',
        'content',
        'sub_cat',
        'category_id'
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    // Relation pour obtenir les sous-catégories
    public function subCategory()
    {
        return $this->hasMany(Category::class, 'category_id');
    }

    // Relation pour obtenir la catégorie parent
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Relation avec les produits
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }




    public function getTotalProductCount()
    {
        $total = $this->products()->count();

        foreach ($this->subcategory as $childCategory) {
            $total += $childCategory->products()->count(); // Alt kategorilerdeki ürün sayısını totale ekle
        }

        return $total;
    }


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
