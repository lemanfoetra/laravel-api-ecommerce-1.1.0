<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product\Product;

class Review extends Model
{
    protected $fillable = [
        'product_id', 'customer', 'review', 'star'
    ];
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
