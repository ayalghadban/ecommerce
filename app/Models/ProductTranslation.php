<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductTranslation extends Model
{
    use HasFactory;
    protected $table = 'product_translations';
    protected $fillable = [
        'product_id' , 'name', 'local'
    ];
    public function product1() :BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}

