<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable =['category_id', 'description','price', 'image','is_featured'];

    public function category1():BelongsTo
    {
        return $this->belongsTo(Category::class, 'id', 'category_id');
    }
    public function translate1(): HasMany
    {
        return $this->hasMany(ProductTranslation::class, 'product_id', 'id');
    }
    
}
