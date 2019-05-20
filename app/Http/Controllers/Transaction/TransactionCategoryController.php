<?php

namespace App\Http\Controllers\Transaction;

use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class TransactionCategoryController extends ApiController
{


    public function index(Transaction $transaction)
    {
        $cat = $transaction->product->categories;
        return $this->showAll($cat);
    }


    /*public function index($id)
    {
        //
        $transaction = Transaction::find($id);
        $cat = $transaction->product->categories;
        return $this->showAll($cat);

    }*/
}
