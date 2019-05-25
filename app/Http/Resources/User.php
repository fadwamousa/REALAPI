<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class User extends Resource
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
          'Identifier' => $this->id,
          'Name_User'  => $this->name,
          'Email_user' => $this->email,
          'Admin'      => $this->admin,
          'IsVerified' => $this->verified,
          'created_at' => $this->created_at->diffForHumans(),
          'updated_at' => $this->updated_at->diffForHumans(),
          'delete_at'  => isset($this->deleted_at) ? $this->deleted_at : null
        ];
        return parent::toArray($request);
    }
}
