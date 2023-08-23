<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $fillable = ['image'];
    public function products() : HasMany
    {
        return $this->hasMany(Product::class,'category_id','id');
    }
    public function translate() : HasMany
    {
        return $this->hasMany(CategoryTranslation::class,'category_id','id');
    }
}
