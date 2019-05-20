<?php

namespace App\Http\Controllers\Buyer;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Buyer;
class BuyerController extends ApiController
{

    public function index()
    {

        $buyers = Buyer::has('transactions')->get();
        //return response()->json(['data'=>$buyers],200);
        return $this->showAll($buyers);
    }


    public function show(Buyer $buyer)
    {
         //$buyer = Buyer::has('transactions')->findOrFail($id);
         return $this->showOne($buyer);
        //transactions name of function

        //$buyer = Buyer::has('transactions')->findOrFail($id);

        //return response()->json(['data'=>$buyer],200);


    }


}
