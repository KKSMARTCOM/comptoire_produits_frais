<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionBanner extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_id',
        'image',
        'title',
        'description',
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
