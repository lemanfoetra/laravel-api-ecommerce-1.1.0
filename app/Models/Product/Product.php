<?php

namespace App\Models\Product;

use App\Models\Product\Review;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'user_id', 'name', 'detail', 'price', 'discount', 'stock'
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
