<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
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
            'customer'  => $this->customer,
            'review'    => $this->review,
            'star'      => $this->star,
            'link'      => [
                'link'  => route('review.show',[$this->product_id, $this->id]),
            ]
        ];
    }
}
