<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group( function() {
    
    Auth::routes();
});


Route::prefix('v1')->namespace('Api\V1')->group( function () {

    Route::get('/user', function () {
        return auth()->user();
    });
    Route::resource('category', 'CategoryController');
    Route::resource('product', 'ProductController');
});
