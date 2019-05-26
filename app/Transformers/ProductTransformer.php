<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Product;
class ProductTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Product $product)
    {
      return [

          'identify'    => (int)$product->id,
          'title'       => (string)$product->name,
          'detail'      => (string)$product->description,
          'stock'       => (int)$product->quantity,
          'status'      => (string)$product->status,
          'seller'      => (int) $product->seller_id,
          'picture'     => url("img/{$product->image}"),
          'creationDate'=> (string)$product->created_at,
          'Deleted_at'  => isset($product->deleted_at) ? (string)$product->deleted_at : null
    ];
    }

    public static function originalAttribute($index){

      $attributes =  [

        'identify' => 'id',
        'title'     => 'name',
        'details'    =>'description',
        'stock'      => 'quantity',
        'status'     => 'status',
        'seller'     => 'seller_id',
        'picture'    => 'image'
        'creationDate'=>'created_at',
        'Deleted_at'  => 'deleted_at'

      ];

      return isset($attributes[$index]) ? $attributes[$index] :null;

    }
}
