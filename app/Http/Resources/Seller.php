<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Seller extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
          'seller_id'  => $this->seller,
          'SellerName' => $this->name,
          'SellerEmail'=> $this->email,

          'IsVerified' => $this->verified,
          'created_at' => $this->created_at->diffForHumans(),
          'updated_at' => $this->updated_at->diffForHumans(),
          'delete_at'  => isset($this->deleted_at) ? $this->deleted_at : null
        ];
        return parent::toArray($request);
    }
}
