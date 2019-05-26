<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Scope\sellerScope;
use App\Transformers\SellerTransformer;

class Seller extends User
{

    protected static  function boot(){
      parent::boot();
      static::addGlobalScope(new sellerScope);
    }

    public $transformer = SellerTransformer::class;

    public function products(){
      return $this->hasMany(Product::class);
    }
}
