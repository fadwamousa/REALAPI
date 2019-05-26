<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Transaction;
class TransactionTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Transaction $transaction)
    {
        return [

            'identify'   => (int)$transaction->id,
            'quantity'   => (int)$transaction->quantity,
            'buyer'      => (int)$transaction->buyer_id,
            'product'    =>(int)$transaction->product_id,
            'creationDate'=> (string)$transaction->created_at,
            'Deleted_at'  => isset($transaction->deleted_at) ? (string)$transaction->deleted_at : null
      ];
  }

  public static function originalAttribute($index){

    $attributes =  [

      'identify'   => 'id',
      'quantity'   =>'quantity',
      'buyer'      => 'buyer_id',
      'product'    =>'product_id',
      'creationDate'=> 'created_at',
      'Deleted_at'  =>'deleted_at'
];

    ];

    return isset($attributes[$index]) ? $attributes[$index] :null;

  }
}
