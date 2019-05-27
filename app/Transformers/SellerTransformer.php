<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Seller;
class SellerTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Seller $seller)
    {
      return [

        'identify' => (int)$seller->id,
        'name_user'=> (string)$seller->name,
        'email'    => (string)$seller->email,
        'isVerified'=>(int)$seller->verified,
        'creationDate'=> (string)$seller->created_at,
        'Deleted_at'  => isset($seller->deleted_at) ? (string) $seller->deleted_at : null

      ];
    }

    public static function originalAttribute($index){

      $attributes =  [

        'identify' => 'id',
        'name_user'=> 'name',
        'email'    => 'email',
        'isVerified'=>'verified',
        'creationDate'=> 'created_at',
        'Deleted_at'  => 'deleted_at'

      ];

      return isset($attributes[$index]) ? $attributes[$index] :null;

    }
}