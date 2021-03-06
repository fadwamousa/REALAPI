<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;

trait ApiResponser{

  private function successResponse($data,$code){

    return response()->json($data,$code);

  }

  protected  function errorResponse($message , $code){

    return response()->json(['messages'=>$message , 'code'=>$code],$code);

  }

  protected  function showAll(Collection $collection , $code = 200){

    if($collection->isEmpty()){
      return $this->successResponse(['data'=>$collection],$code);
    }

    $transformer = $collection->first()->transformer;
    $collection  = $this->filterData($collection,$transformer);
    $collection  = $this->sortData($collection,$transformer);
    $collection  = $this->paginate($collection);
    $collection  = $this->transformData($collection , $transformer );

    $collection  = $this->cacheResponse($collection);

    return $this->successResponse(['data'=>$collection],$code);

  }

      protected function showOne(Model $instance, $code = 200)
        {
          $transformer = $instance->transformer;
          $instance = $this->transformData($instance, $transformer);
          return $this->successResponse($instance, $code);
        }

    protected  function showMessage($message , $code = 200){

        return $this->successResponse(['data'=>$message],$code);

      }

      protected  function transformData($data , $transformer){

        $transformation = fractal($data, new $transformer);//package

        return $transformation->toArray(); //convert to array

        }

        protected function filterData(Collection $collection , $transform){

          foreach (request()->query() as $query => $value) {
            $attribute = $transformer::originalAttribute($query);
          }

          if(isset($attribute , $value)){
            $collection = $collection->where($attribute , $value);
          }

          return $collection;

        }


        protected function sortData(Collection $collection , $transformer){

          //this is function return collection depending sorting or not

          if(request()->has('sort_by')){
            $attribute = $transformer::originalAttribute(request()->sort_by);
            $collection = $collection->sortBy($attribute);
            //attribute may be any thing name or id
            //$collection = $collection->sortBy->{$attribute};
          }

          return $collection;

        }


        protected  function paginate(Collection $collection){

          $page = LengthAwarePaginator::resolveCurrentPage();
          //القيمة الافتراضية  للصفحة الحالية
          //LengthAwarePaginator this is class allow us  paginate every kind of Collection
          //resolveCurrentPage obtian the current page (which the current page on it )


          $perPage = 15; //element in page

          $results = $collection->slice(($page - 1) * $perPage, $perPage)->values();

          $paginated = new LengthAwarePaginator($results, $collection->count(), $perPage, $page, [
              'path' => LengthAwarePaginator::resolveCurrentPath()
          ]);

          //path mean the next page or pervious page

          $paginated->appends(request()->all());

          return $paginated;


        }

      /*  protected function paginate(Collection $collection)
      	{
      		$rules = [
      			'per_page' => 'integer|min:2|max:50',
      		];
      		Validator::validate(request()->all(), $rules);
      		$page = LengthAwarePaginator::resolveCurrentPage();
      		$perPage = 15;
      		if (request()->has('per_page')) {
      			$perPage = (int) request()->per_page;
      		}
      		$results = $collection->slice(($page - 1) * $perPage, $perPage)->values();
      		$paginated = new LengthAwarePaginator($results, $collection->count(), $perPage, $page, [
      			'path' => LengthAwarePaginator::resolveCurrentPath(),
      		]);
      		$paginated->appends(request()->all());
      		return $paginated;
  	  }*/


      protected function cacheResponse($data)
      	{

          //this is function works after transform data to array
          //so cacheResponse not receive collection
          //it is receive a new data
      		$url = request()->url();
      		$queryParams = request()->query();
      		ksort($queryParams); //k mean key
      		$queryString = http_build_query($queryParams);
          //Generates a URL-encoded query string from the associative
          //(or indexed) array provided.
      		$fullUrl = "{$url}?{$queryString}";
      		return Cache::remember($fullUrl, 30/60, function() use($data) {
      			return $data;
      		});
      	}
}
