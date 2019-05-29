<?php

namespace App\Http\Controllers\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Category;
use App\Transformers\CategoryTransformer;
class CategoryController extends ApiController
{

public function __construct(){

 $this->middleware('client.credentials')->only(['index', 'show']);    //recieve new parameters that is name of Transformers

  $this->middleware('transform.input:' . CategoryTransformer::class)->only(['store', 'update']);    //recieve new parameters that is name of Transformers
}

    public function index()
    {
        $categories = Category::all();
        return $this->showAll($categories);
    }



    public function store(Request $request)
    {
        //
        $rules = [
          'name' => 'required|unique:categories',
          'description' => 'required|min:10'
        ];

        $this->validate($request,$rules);
        //dd($request->all());
        $categories = Category::create($request->all());
        return $this->showOne($categories);
        //return $this->successResponse($categories,200);
    }


    public function show(Category $category)
    {
        //

        return $this->showOne($category);
    }



    public function update(Request $request, Category $category)
    {
      //check if any cahnge happen by using Fill Method
      $category->fill($request->only(['name','description']));
      //that mean if not any change in code (isDirty)
      if(!$category->isDirty()){
        return $this->errorResponse('you need to add some change in your data',422);
      }
      /*if($category->isClean()){
        return $this->errorResponse('you need to add some change in your data',422);
      }*/

      $category->save();
      return $this->showOne($category);
    }


    public function destroy(Category $category)
    {
        //
          $category->delete();
          return $this->showOne($category);
    }
}
