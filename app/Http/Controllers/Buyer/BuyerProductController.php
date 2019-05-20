<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class BuyerProductController extends ApiController
{

    public function index(Buyer $buyer)
    {
      //Now the buyer has many a transaction but the transaction noy=t has many of product but
      // it belongs to product so i want to get only products depend on buyers
      // now we use the query builder
      //but i want the only products without transaction
      //pluck is going to collection called transcation and get only products
      $products  = $buyer->transactions()->with('product')->get()->pluck('product');
      return $this->showAll($products);


    }

}
