<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Buyer;
class BuyerTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Buyer $buyer)
    {
      return [

        'identify' => (int)$buyer->id,
        'name_user'=> (string)$buyer->name,
        'email'    => (string)$buyer->email,
        'isVerified'=>(int)$buyer->verified,

        'creationDate'=> (string)$buyer->created_at,
        'Deleted_at'  => isset($buyer->deleted_at) ? (string)$buyer->deleted_at : null,
        'links' => [
          [
            'rel'  => 'self',
            'href' => route('buyers.show',$buyer->id),
          ],
          [
            'rel'  => 'buyers.transactions',
            'href' => route('buyers.transactions.index',$buyer->id),
          ],
          [
            'rel'  => 'buyers.products',
            'href' => route('buyers.products.index',$buyer->id),
          ],
          [
            'rel'  => 'buyers.sellers',
            'href' => route('buyers.sellers.index',$buyer->id),
          ],
          [
            'rel'  => 'buyers.categories',
            'href' => route('buyers.categories.index',$buyer->id),
          ],
          [
                   'rel' => 'user',
                   'href' => route('users.show', $buyer->id),
          ],

        ],
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
