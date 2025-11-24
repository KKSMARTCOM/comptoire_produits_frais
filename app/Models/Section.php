<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = ['name', 'image', 'slug', 'description'];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function banners()
    {
        return $this->hasMany(SectionBanner::class);
    }

    public function services()
    {
        return $this->hasMany(SectionService::class);
    }

    public function productCategories()
    {
        return $this->hasMany(SectionProductCategory::class);
    }

    public function about()
    {
        return $this->hasOne(SectionAbout::class);
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
