<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\User;

class UserTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [

          'identify' => (int)$user->id,
          'name_user'=> (string)$user->name,
          'email'    => (string)$user->email,
          'isVerified'=>(int)$user->verified,
          'Admin'     => ($user->admin === 'true'),
          'creationDate'=> (string)$user->created_at,
          'Deleted_at'  => isset($user->deleted_at) ? (string)$user->deleted_at : null

        ];
    }

    public static function originalAttribute($index){

      $attributes =  [

        'identify' => 'id',
        'name_user'=> 'name',
        'email'    => 'email',
        'isVerified'=>'verified',
        'Admin'     =>'admin',
        'creationDate'=> 'created_at',
        'Deleted_at'  => 'deleted_at'

      ];

      return isset($attributes[$index]) ? $attributes[$index] :null;

    }
}
