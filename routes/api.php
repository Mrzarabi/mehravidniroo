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

Route::prefix('v1')->namespace('Api\V1')->group( function () {

    Route::post('login', 'UserController@login');
    Route::post('register', 'UserController@register');
    Route::post('sendTicket', 'TicketController@sendTicket');

    Route::middleware(['auth:api'])->group( function() {
        Route::resource('category', 'CategoryController');
        Route::resource('product', 'ProductController');
        Route::post('upload/{product}', 'ProductController@upload');
        Route::post('upload/{product}', 'ProductController@updateUpload');

        Route::get('user', 'UserController@index');
        Route::get('user/{user}', 'UserController@show');
        Route::put('user/{user}', 'UserController@update');

        Route::get('ticket', 'TicketController@index');
        Route::get('ticket/{ticket}', 'TicketController@show');
        Route::delete('ticket/{ticket}', 'TicketController@destroy');
    }); 
});
