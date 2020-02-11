<?php

namespace App\Http\Controllers\API\Product;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Http\Resources\Product\ProductResource;
use App\Http\Requests\Product\ProductStore;


class ProductController extends Controller
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
    public function index()
    {
        $user = Auth::user();
        return $user;
        return ProductResource::collection(Product::paginate(5));
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
    public function store(ProductStore $request)
    {
        $user       = Auth::user();
        $product    = new Product();

        $product->user_id   = $user->id;
        $product->name      = $request->name;
        $product->detail    = $request->detail;
        $product->price     = $request->price;
        $product->discount  = $request->discount;
        $product->stock     = $request->stock;
        $result = $product->save();


        return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $user = Auth::user();

        if($user->id == $product->user_id){
            if(isset($request['user_id'])){
                unset($request['user_id']);
            }
            $product->update($request->all());

            return response()->json(
                [
                    'status'    =>  'success',
                    'message'   =>  'Produk disimpan',
                    'result'    =>  $request->all(),
                ], 
                200
            );
        }
        
        return response()->json(
            [
                'status'    =>  'gagal',
                'message'   =>  'Produk gagal disimpan',
            ], 
            200
        );
    }


    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $user = Auth::user();

        if($user->id == $product->user_id){
            $product->where('id', $product->id);
            $product->delete();

            return response()->json(
                [
                    'status'    =>  'success',
                    'message'   =>  'Produk Dihapus',
                ], 
                200
            );
        }
        return response()->json(
            [
                'status'    =>  'failed',
                'message'   =>  'Produk Gagal Dihapus',
            ], 
            200
        );
    }
}
