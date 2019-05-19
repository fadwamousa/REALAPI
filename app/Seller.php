<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\sellerScope;

class Seller extends User
{

    public function boot(){
      parent::boot();
      static::addGlobalScope(new sellerScope);
    }

    public function products(){
      return $this->hasMany(Product::class);
    }
}
