<?php

use Illuminate\Support\Facades\Route;
use Pivlu\SamplePackage\Http\Controllers\SampleController;

Route::get('/sample-package', [SampleController::class, 'index'])
   ->middleware('sample.middleware') 
   ->name('sample-package.index'); 