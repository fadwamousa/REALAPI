<?php

namespace App\Http\Middleware;

use Closure;

class SignatorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next , $headerName = 'X-Application-Name')
    {
      //this is middleware add the header name with your responses
        $response =  $next($request);

        $response->headers->set($headerName , config('app.name'));

        return $response;
    }
}
