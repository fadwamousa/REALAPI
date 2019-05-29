<?php

namespace App\Http\Controllers\Category;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class CategoryProductController extends ApiController
{

  public function __construct(){

   $this->middleware('client.credentials')->only(['index']);    //recieve new parameters that is name of Transformers


  }

    public function index(Category $category)
    {
        //
        $products = $category->products;
        return $this->showAll($products);
    }


}
