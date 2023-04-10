<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Auth\Events\Validated;


class CategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::all();
        return $this->showAll($category);
    }

   

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules=[
            'name' =>'required',
            'description' =>'required'
        ];
      //  $this->validate($request, $rules);
        $newCategory= Category::create($request->all()) ;
        return $this->showOne($newCategory,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
    
        return $this->showOne($category,201);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
    $category->fill([
        'name',
        'description'    
    ]);  /// Not working

    if($category->isClean()){
        return $this->errorResponse('You need to specify any diffrent value for update', 422);
    }
    $category->save();

    return $this->showOne($category);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return $this->showOne($category);
    }
}
