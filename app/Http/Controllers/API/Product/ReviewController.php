<?php

namespace App\Http\Controllers\API\Product;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product\Review;
use App\Models\Product\Product;
use App\Http\Resources\Product\ReviewResource;
use App\Http\Requests\Product\ReviewStoreRequest;

class ReviewController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:api')->except('index','show');
    }
    


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        return ReviewResource::collection($product->reviews);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Product $product, ReviewStoreRequest $request)
    {
        $user   = Auth::user();
        $review = new Review();

        $review->product_id = $product->id;
        $review->customer   = $user->name;
        $review->review     = $request->review;
        $review->star       = $request->star;
        $result = $review->save();
        if($result){
            return response()->json(
                [
                    'status'    =>  'success',
                    'message'   =>  'Review Berhasil disimpan.',
                    'data'      =>  $request->all(),
                ], 
                200
            );
        }

        return response()->json(
            [
                'status'    =>  'gagal',
                'message'   =>  'Review gagal disimpan',
            ], 
            404
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product, Review $review)
    {
        return $review;
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Product $product, Request $request, Review $review)
    {
        $review->where('id', $review->id);
        $result = $review->update($request->all());
        return $request;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, Review $review)
    {
        $user = Auth::user();
        if($product->id == $review->product_id AND $product->user_id == $user->id){
            $review->where('id', $review->id);
            $result = $review->delete();
            if($result){
                return response()->json(
                    [
                        'status'    =>  'success',
                        'message'   =>  'Review Berhasil dihapus',
                    ], 
                    200
                );
            }
        }
        return response()->json(
            [
                'status'    =>  'failed',
                'message'   =>  'Review gagal dihapus',
            ], 
            404
        );
    }
}
