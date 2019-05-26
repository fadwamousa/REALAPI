<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Category;
class CategoryTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Category $category)
    {
      return [

        'identify'   => (int)$category->id,
        'title'      => (string)$category->name,
        'details'    => (string)$category->description,
        'creationDate'=>  (string)$category->created_at,
        'Deleted_at'  => isset($category->deleted_at) ? (string)$category->deleted_at : null

      ];
    }

    public static function originalAttribute($index){

      $attributes =  [

        'identify' => 'id',
        'title'     => 'name',
        'details'    =>'description',
        'creationDate'=>'created_at',
        'Deleted_at'  => 'deleted_at'

      ];

      return isset($attributes[$index]) ? $attributes[$index] :null;

    }
}
