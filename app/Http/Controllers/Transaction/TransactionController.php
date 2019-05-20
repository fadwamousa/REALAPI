<?php

namespace App\Http\Controllers\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Transaction;
class TransactionController extends ApiController
{

    public function index()
    {

        //$transactions =  Transaction::has('buyer')->get();
        $transactions =  Transaction::all();
        return $this->showAll($transactions);
    }


    public function show(Transaction $transaction)
    {

        return $this->showOne($transaction);
    }


}
