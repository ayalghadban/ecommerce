<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'product_price',
        'product_quantity',
        'product_status',
        'product_main_image',
        'is_highlight',
        'is_active',
        'is_latest',
        'expired_date',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_highlight' => 'boolean',
        'is_latest'=> 'boolean',
    ];

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function productTranslations()
    {
        return $this->HasMany(ProductTranslation::class);
    }

    public function images()
    {
        return $this->morphMany(MorphMedia::class, 'morph_filable');
    }

}
