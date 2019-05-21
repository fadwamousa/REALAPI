<?php

namespace App\Http\Controllers\Seller;

use App\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class SellerCategoryController extends ApiController
{

    public function index(Seller $seller)
    {
        //
        $category = $seller->products()
                           ->whereHas('categories')
                           ->with('categories')
                           ->get()
                           ->pluck('categories')
                           ->collapse();

        return $this->showAll($category);                   

    }



}
