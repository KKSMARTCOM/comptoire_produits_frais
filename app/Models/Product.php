<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    use Sluggable, HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'image',
        'category_id',
        'price',
        'quantity',
        'status',
        'content',
    ];

    public function productCategory()
    {
        return $this->belongsTo(Category::class, 'category_id');
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
