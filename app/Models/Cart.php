<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'sub_total',
        'delivery_fees',
        'overall_total',
        'cart_items_count',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsToOne(User::class);
    }
    public function cartItems() : HasMany
    {
        return $this->hasMany(CartItem::class);
    }
}
