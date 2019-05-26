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
        'creationDate'=> $seller->created_at,
        'Deleted_at'  => isset($seller->deleted_at) ? (string) $seller->deleted_at : null

      ];
    }
}
