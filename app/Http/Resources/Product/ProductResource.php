<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'detail'    => $this->detail,
            'price'     => $this->price,
            'total_price'   => round($this->price - (($this->discount / 100) * $this->price)),
            'stock'     => $this->stock,
            'discount'  => $this->discount,
            'product'   =>[
                'link'  => route('product.show',$this->id),
            ],
            'review'    => [
                'link'  => route('review.store',$this->id),
            ],
        ];
    }
}
