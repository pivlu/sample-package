<?php

namespace Pivlu\SamplePackage\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Response;

class ExampleMiddleware
{
   public function handle($request, Closure $next)
   {

      if ($request->has('allow')) {
         return $next($request);
      }

      return response('Access Denied!', 403);
   }
}