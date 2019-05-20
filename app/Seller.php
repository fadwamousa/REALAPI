<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Scope\sellerScope;

class Seller extends User
{

    protected static  function boot(){
      parent::boot();
      static::addGlobalScope(new sellerScope);
    }

    public function products(){
      return $this->hasMany(Product::class);
    }
}
