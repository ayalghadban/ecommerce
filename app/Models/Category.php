<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'image'];

    public function subCategory() : HasMany {
        return $this->hasMany(SubCategory::class);
    }

    public function product() : HasMany {
        return $this->hasMany(Product::class);
    }
    
    public function images()
    {
        return $this->morphMany(MorphMedia::class, 'morph_filable');
    }
}
