<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\V1\CategoryCollection;
use App\Http\Resources\V1\CategoryResource;
use App\Models\Category;
use http\Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return CategoryCollection
     */
    public function index()
    {
        $categories=Category::paginate(10);
        return new CategoryCollection($categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return Response
     */
    public function store(CategoryRequest $request)
    {
        $category=new Category();
        $category->name=$request->name;
        $category->slug=$request->slug;
        $category->parent_id=$request->parent_id;
        $category->save();
        return response()->json([
            'data'=>new CategoryResource($category),
            'status'=>'success'
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return CategoryResource
     *
     */
    public function show(Category $category)
    {
            return new CategoryResource($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param Category $category
     * @return Response
     */
    public function update(CategoryRequest $request,Category  $category)
    {
        $category->name=$request->name;
        $category->slug=$request->slug;
        $category->parent_id=$request->parent_id;
        $category->save();
        return response()->json([
            'data'=>new CategoryResource($category),
            'status'=>'success'
        ],201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return JsonResponse
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json([
            'data'=>'deleted category',
            'status'=>'success'
        ],201);
    }
}
