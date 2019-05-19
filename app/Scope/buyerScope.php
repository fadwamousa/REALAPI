<?php
namespace App\Scope;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class buyerScope implements Scope{


  public function apply(Builder $builder , Model $model){

    $builder->has('transactions');
  }



}
