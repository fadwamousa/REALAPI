<?php

namespace App\Http\Controllers\Transaction;

use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class TransactionSellerContoller extends ApiController
{
    public function index(Transaction $transaction)
    {
        //Get me the seller of product that happen transcation in it

        $seller = $transaction->product->seller;
        return $this->showOne($seller);

    }


}
