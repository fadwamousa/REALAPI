<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    //
    use SoftDeletes;
    protected $dates    = ['deleted_at'];

    const UNAVAILABLE_PRODUCT = 'unavailable';
    const AVAILABLE_PRODUCT = 'available';

    protected $fillable = [
      'name',
      'description',
      'image',
      'quantity',
      'status',
      'seller_id'
    ];
   //always model contain foreign key is belongs to
   public function seller(){
     return $this->belongsTo(Seller::class);
   }

   public function transactions(){
     return $this->hasMany(Transaction::class);
   }

    public function categories(){
      return $this->belongsToMany(Category::class,'category_product');
    }

    public function isAvailable(){
      return $this->status == Product::AVAILABLE_PRODUCT;
    }
}
