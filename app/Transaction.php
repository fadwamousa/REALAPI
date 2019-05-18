<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    

    protected $fillable = [
      'quantity',
      'product_id',
      'buyer_id'
    ];

    public function buyer(){
      return $this->belongsTo(Buyer::class);
    }
    public function product(){
      return $this->belongsTo(Product::class);
    }

}
