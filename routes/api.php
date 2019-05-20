<?php

use Illuminate\Http\Request;

/*
* Buyer
*show me the index page and show page only
*/

Route::resource('buyers','Buyer\BuyerController',['only'=>['index','show']]);
Route::resource('buyers.transactions','Buyer\BuyerTransactionController',['only'=>['index']]);
Route::resource('buyers.products','Buyer\BuyerProductController',['only'=>['index']]);
Route::resource('buyers.sellers','Buyer\BuyerSellerController',['only'=>['index']]);

/*
* Category
* show me the all pages except the create and edit pages
*/
Route::resource('categories','Category\CategoryController',['except'=>['create','edit']]);

/*
* Product
*/
Route::resource('products','Product\ProductController',['only'=>['index','show']]); //show me the index page and show page only
/*
* Seller
*/
Route::resource('sellers','Seller\SellerController',['only'=>['index','show']]); //show me the index page and show page only
/*
* transaction
*/
Route::resource('transaction','Transaction\TransactionController',['only'=>['index','show']]); //show me the index page and show page only
Route::resource('transaction.categories','Transaction\TransactionCategoryController',['only'=>['index']]); //show me the index page
Route::resource('transaction.sellers','Transaction\TransactionSellerContoller',['only'=>['index']]); //show me the index page

/*
* user
*/
Route::resource('users','User\UserController',['except'=>['create','edit']]); //show me the index page and show page only
