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
        'Deleted_at'  => isset($buyer->deleted_at) ? (string)$buyer->deleted_at : null




      ];
    }
}
