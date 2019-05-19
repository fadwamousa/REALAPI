<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\buyerScope;
class Buyer extends User
{

    public function boot(){
      parent::boot();
      static::addGlobalScope(new buyerScope);
    }
    public function transactions(){
      return $this->hasMany(Transaction::class);
    }
}
