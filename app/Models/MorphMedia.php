<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MorphMedia extends Model
{
    use HasFactory;
    protected $fillable = [
        'morph_filable',
        'media_path',
        'media_name',
        'media_type',
    ];
    
    // Relationships

    public function morph_filable()
    {
        return $this->morphTo();
    }
}
