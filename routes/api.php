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
//this Routes for users who thy don't have anything but we need namespace for controller
Route::prefix('v1/free')->namespace('Api\V1')->group( function() {

    Route::get('product', 'ProductController@index');
    Route::get('product/{product}', 'ProductController@show');
    // TODO
    Route::get('product/search/{query?}', 'ProductController@search');

    Route::get('category', 'CategoryController@index');
    Route::get('category/{category}', 'CategoryController@show');
    Route::get('category/search/{query?}', 'CategoryController@search');
});

//this Routes for users who thy don't have anything and we don't need namespace for controller
Route::prefix('v1/free/template')->group( function() {

    Route::get('product', 'Controller@resentProduct');
    Route::post('sort/product', 'Controller@sortProduct');
});

// this Route group for users who they don't have anything  but we need namespacce for controller
Route::prefix('v1')->namespace('Api\V1')->group( function () {
    
    Route::post('login', 'UserController@login');
    Route::post('register', 'UserController@register');
    
    Route::get('category', 'CategoryController@index');
    Route::get('category/{category}', 'CategoryController@show');
    Route::get('category/search/{query?}', 'CategoryController@search');
    
    //TODO 
    Route::post('filter/{filters}', 'ProductController@productFilter');
    
    // this Route group for users who login and they have role 100...
    Route::middleware(['auth:api', 'role:100e82ba-e1c0-4153-8633-e1bd228f7399'])->group( function() {

        Route::resource('category', 'CategoryController');
        
        Route::resource('product', 'ProductController');
        Route::post('upload/{product}', 'ProductController@upload');
        Route::post('update/upload/{product}', 'ProductController@updateUpload');
        Route::put('multi/delete/product', 'ProductController@multiDelete');
        Route::get('product/search/{query?}', 'ProductController@search');
        
        Route::resource('comment', 'CommentController');
        Route::post('comment/show/{comment}', 'CommentController@isShow');
        Route::post('comment/status/{comment}', 'CommentController@commentStatus');
        Route::put('multi/delete/comment', 'CommentController@multiDelete');
        
        Route::resource('user', 'UserController');
        Route::put('multi/delete/user', 'UserController@multiDelete');
        Route::get('user/search/{query?}', 'UserController@search');
        
        Route::post('attach/role/{user}', 'RoleController@attachRole');
        Route::post('detach/role/{user}', 'RoleController@detachRole');

        Route::resource('ticket', 'TicketController');
        Route::post('send/ticket', 'TicketController@sendTicket');
        Route::post('ticket/status/{ticket}', 'TicketController@ticketStatus');
    }); 

    // this Route group for users who just login 
    Route::middleware('auth:api')->group( function() {
        
        Route::get('user/{user}', 'UserController@show');
        Route::put('user/{user}', 'UserController@update');
        
        Route::get('product', 'ProductController@index');
        Route::get('product/{product}', 'ProductController@show');
        Route::get('product/search/{query?}', 'ProductController@search');
        
        Route::post('comment', 'CommentController@store');

        Route::post('send/ticket', 'TicketController@sendTicket');
    });
});

// this Route group for users who login but we should connect to main controller without namespace
Route::prefix('v1/template')->middleware('auth:api')->group( function() {

    Route::get('product', 'Controller@resentProduct');
    Route::post('sort/product', 'Controller@sortProduct');
}); 