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
          'creationDate'=> $product->created_at,
          'Deleted_at'  => isset($product->deleted_at) ? (string)$product->deleted_at : null
    ];
    }
}
