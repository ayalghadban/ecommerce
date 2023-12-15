<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'name', 'image'];

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function product() : HasMany {
        return $this->hasMany(Product::class);
    }
    public function images()
    {
        return $this->morphMany(MorphMedia::class, 'morph_filable');
    }
}
