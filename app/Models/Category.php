<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_image',
        'is_active',
        'parent_id',
        'level',
    ];


    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'parent_id')->with('categoryTranslations');
    }
    public function categoryTranslations()
    {
        return $this->HasMany(CategoryTranslation::class);
    }
}
