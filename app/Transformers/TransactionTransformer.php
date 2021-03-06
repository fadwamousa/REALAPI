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
            'Deleted_at'  => isset($transaction->deleted_at) ? (string)$transaction->deleted_at : null,
            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('transaction.show', $transaction->id),
                ],
                [
                    'rel' => 'transaction.categories',
                    'href' => route('transaction.categories.index', $transaction->id),
                ],
                [
                    'rel' => 'transaction.sellers',
                    'href' => route('transaction.sellers.index', $transaction->id),
                ],
                [
                    'rel' => 'buyers',
                    'href'=> route('buyers.show',$transaction->buyer->id),
                ],
                [
                    'rel' => 'products',
                    'href'=> route('products.show',$transaction->product->id),
                ]

            ]
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

    return isset($attributes[$index]) ? $attributes[$index] :null;

  }
}
