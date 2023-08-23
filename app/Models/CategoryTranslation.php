<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CategoryTranslation extends Model
{
    use HasFactory;
    protected $table = 'category_translations';
    protected $fillable = ['category_id' , 'name', 'local'];
    public function category() :BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
