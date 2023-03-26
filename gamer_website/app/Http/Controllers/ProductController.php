<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\productResource;

class ProductController extends Controller
{

    public function index()
    {
        $products=Product::with('category')->with('user')->get();
        return productResource::collection($products);
    }

    public function store(ProductRequest $request)
    {
        Product::create([
            'name'=> $request->name,
            'description'=> $request->description,
            'quantity'=> $request->quantity,
            'price'=> $request->price,
            'image'=> $request->image,
            'category_id'=> $request->category_id,
            'seller_id'=> Auth()->user()->id
        ]);
        return response()->json([
            'message'=>'Product added succesfully !',
        ]);
    }


    public function show(Product $product)
    {
        $product->category;
        $product->user;
        return new productResource($product);
    }


 
    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->all());
        return response()->json([
            'message'=>'Product updated succesfully !',
        ]);
    }

 
    public function destroy(Product $product)
    {
        Product::destroy($product->id);
        return response()->json([
            'message'=>'Product deleted succesfully !',
        ]);
    }
  
    public function searchByTitle($searching)
    {
        $product = Product::where('name','LIKE', "$searching%")->get();
        if(count($product)==0) {
            return response()->json([
                'message'=>'No products found !',
            ]);
        }
        return response()->json([
            'message'=>'The product(s) you are looking for :',
            'Products'=> productResource::collection($product),
        ]);
    }

    public function searchByCategory($searching)
    {
        $product=Product::join('categories','categories.id','=','products.category_id')
                          ->where('category','LIKE', "$searching%")->get();
        if(count($product)==0) {
            return response()->json([
                'message'=>'No products found !',
            ]);
        }
        return response()->json([
            'message'=>'The product(s) you are looking for :',
            'Products'=> productResource::collection($product),
        ]);
    }

}
