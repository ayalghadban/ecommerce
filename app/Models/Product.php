<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'sub_category_id', 'name', 'description', 'price', 'image'];

    public function subCategory() : BelongsTo {
        return $this->belongsTo(SubCategory::class);
    }

    public function category() : BelongsTo {
        return $this->belongsTo(Category::class);
    }
    public function images()
    {
        return $this->morphMany(MorphMedia::class, 'morph_filable');
    }
}
