<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Seller;

class SellerController extends Controller
{

    public function index()
    {
        //
        $sellers = Seller::has('products')->get();
        return response()->json(['data'=>$sellers],200);
        //200 response HTTP mean everything is ok

    }

    public function show($id)
    {
        //
        $seller = Seller::has('products')->findOrFail($id);
        return response()->json(['data'=>$seller],200);
    }


}
