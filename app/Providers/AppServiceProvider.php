<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use App\Mail\UserCreated;
use App\Mail\UserChanged;

use App\User;
use App\Product;

class AppServiceProvider extends ServiceProvider
{

    public function boot()
    {
        //
        Schema::defaultStringLength(191);

        //we will create the event every time user created send him email

        User::created(function($user){
          retry(5,function() use($user){
            Mail::to($user)->send(new UserCreated($user));
          },100);
          //5 times and between the 5 is 100 milesecond 
        });

        User::updated(function($user){

          if($user->isDirty('email')){

            Mail::to($user)->send(new UserChanged($user));

          }

        });


        Product::updated(function($product){
          if($product->quantity == 0 && $product->isAvailable() ){
            $product->status = Product::UNAVAILABLE_PRODUCT;

            $product->save();
          }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
