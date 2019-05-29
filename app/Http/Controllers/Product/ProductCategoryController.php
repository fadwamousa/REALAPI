<?php

namespace App\Http\Controllers\Product;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Category;
class ProductCategoryController extends ApiController
{

  public function __construct(){

   $this->middleware('client.credentials')->only(['index']);    //recieve new parameters that is name of Transformers


  }


    public function index(Product $product)
    {

        $categories = $product->categories;
        return $this->showAll($categories);
    }



    public function update(Request $request, Product $product, Category $category)
    {
        //Many To Many (attach & detach & sync) && syncWithoutDetach
        $product->categories()->attach([$category->id]);
        return $this->showAll($product->categories);
    }


    public function destroy(Product $product,Category $category)
    {
        if(!$product->categories()->find($category->id)){
          return $this->errorResponse('category id is not in list of categories',404);
        }

        $product->categories()->detach($category->id);
        return $this->showAll($product->categories);
    }
}
