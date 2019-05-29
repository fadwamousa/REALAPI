<?php

namespace App\Http\Controllers\Transaction;

use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class TransactionCategoryController extends ApiController
{

  public function __construct(){

   $this->middleware('client.credentials')->only(['index']);    //recieve new parameters that is name of Transformers


  }


    public function index(Transaction $transaction)
    {
        $cat = $transaction->product->categories;
        return $this->showAll($cat);
    }


  
}
