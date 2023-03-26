<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\categoryResource;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=Category::all();
        return response()->json(
            ['message' => 'All categories',
            'Categories' => categoryResource::collection($categories)]
        );
    }

    public function store(CategoryRequest $request)
    {
        Category::create($request->all());
        return response()->json([
            'message'=>'Category added succesfully !'
        ]);
    }


    public function show(Category $category)
    {
        return response()->json([
            'message'=>'The category you are looking for :',
            'Category'=> new categoryResource($category),
        ]);
    }


    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->all());
        
        return response()->json([
            'message'=>'Category updated succesfully !'
        ]);
    }

 
    public function destroy(Category $category)
    {
        Category::destroy($category->id);
        return response()->json([
            'message'=>'Category deleted succesfully !'
        ]);
    }
}
