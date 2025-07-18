<?php

namespace Pivlu\SamplePackage\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;

class SampleController extends Controller
{
   public function index()
   {
      $greeting = config('sample-package.greeting');
      return view('sample-package::sample', compact('greeting'));
   }
}