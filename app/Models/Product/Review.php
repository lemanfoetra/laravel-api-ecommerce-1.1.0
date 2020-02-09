<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product\Product;

class Review extends Model
{
    
    public function product()
    {
        $this->belongsTo(Product::class);
    }
}
