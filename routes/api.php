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
Route::get('template/product', 'Controller@resentProduct');
Route::post('template/sort/product', 'Controller@sortProduct');
// Route::post('product/filter/{filters}', 'Api\V1\ProductController@productFilter');

Route::prefix('v1')->namespace('Api\V1')->group( function () {

    Route::post('login', 'UserController@login');
    Route::post('register', 'UserController@register');
    
    Route::get('category', 'CategoryController@index');
    Route::get('category/{category}', 'CategoryController@show');
    Route::get('category/search/{query?}', 'CategoryController@search');
    
    Route::get('free/product', 'ProductController@index');
    Route::get('product/{product}', 'ProductController@show');
    Route::get('product/search/{query?}', 'ProductController@search');
    
    Route::middleware('auth:api')->group( function() {

        Route::get('user/{user}', 'UserController@show');
        Route::put('user/{user}', 'UserController@update');

        Route::post('comment', 'CommentController@store');
        Route::post('send/ticket', 'TicketController@sendTicket');
    });
    
    Route::middleware(['auth:api', 'role:100e82ba-e1c0-4153-8633-e1bd228f7399'])->group( function() {
        Route::post('category', 'CategoryController@store');
        Route::put('category/{category}', 'CategoryController@update');
        Route::delete('category/{category}', 'CategoryController@destroy');
        
        Route::post('product', 'ProductController@store');
        Route::post('upload/{product}', 'ProductController@upload');
        Route::put('product/{product}', 'ProductController@update');
        Route::post('update/upload/{product}', 'ProductController@updateUpload');
        Route::put('multi/delete/product', 'ProductController@multiDelete');
        Route::delete('product/{product}', 'ProductController@destroy');
        
        Route::resource('comment', 'CommentController');
        Route::post('comment/show/{comment}', 'CommentController@isShow');
        Route::post('comment/status/{comment}', 'CommentController@commentStatus');
        Route::put('multi/delete/comment', 'CommentController@multiDelete');
        
        Route::get('user', 'UserController@index');
        Route::delete('user/{user}', 'UserController@destroy');
        Route::put('multi/delete/user', 'UserController@multiDelete');
        Route::get('user/search/{query?}', 'UserController@search');
        
        Route::post('attach/role/{user}', 'RoleController@attachRole');
        Route::post('detach/role/{user}', 'RoleController@detachRole');

        Route::get('ticket', 'TicketController@index');
        Route::get('ticket/{ticket}', 'TicketController@show');
        Route::delete('ticket/{ticket}', 'TicketController@destroy');
        Route::post('send/ticket', 'TicketController@sendTicket');
        Route::post('ticket/status/{ticket}', 'TicketController@ticketStatus');


    }); 

    Route::middleware(['auth:api', 'role:3362c127-65aa-4950-b14f-2fc86b53ea88'])->group( function() {

        Route::get('user/{user}', 'UserController@show');
        Route::put('user/{user}', 'UserController@update');
        Route::post('send/ticket', 'TicketController@sendTicket');
        Route::post('comment', 'CommentController@store');

        // Route::post('template/sort/product', 'Controller@sortProduct');
    }); 
    

});

Route::middleware(['auth:api'])->group( function()
{
    Route::get('v1/product', 'Api\V1\ProductController@index');
    Route::post('v1/template/sort/product', 'Controller@sortProduct');
}); 