<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scope\buyerScope;
use App\Transformers\BuyerTransformer;
class Buyer extends User
{

    protected static  function boot(){
      parent::boot();
      static::addGlobalScope(new buyerScope);
    }

    public $transformer = BuyerTransformer::class;
    public function transactions(){
      return $this->hasMany(Transaction::class);
    }
}
