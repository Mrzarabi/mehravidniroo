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
    
    Route::get('category/search/{query?}', 'CategoryController@search');
    Route::get('product/search/{query?}', 'ProductController@search');
    
    Route::middleware(['auth:api', 'role:100e82ba-e1c0-4153-8633-e1bd228f7399'])->group( function() {
        Route::resource('category', 'CategoryController');
        
        Route::resource('product', 'ProductController');
        Route::put('multi/delete/product', 'ProductController@multiDelete');
        Route::post('upload/{product}', 'ProductController@upload');
        Route::post('update/upload/{product}', 'ProductController@updateUpload');
        
        Route::resource('comment', 'CommentController');
        Route::post('comment/show/{comment}', 'CommentController@isShow');
        Route::post('comment/status/{comment}', 'CommentController@commentStatus');
        Route::put('multi/delete/comment', 'CommentController@multiDelete');
        
        Route::get('user', 'UserController@index');
        Route::get('user/{user}', 'UserController@show');
        Route::put('user/{user}', 'UserController@update');
        Route::delete('user/{user}', 'UserController@destroy');
        Route::put('multi/delete/user', 'UserController@multiDelete');
        Route::get('user/search/{query?}', 'UserController@search');
        
        Route::resource('role', 'RoleController');
        Route::post('attach/role/{user}', 'RoleController@attachRole');
        Route::post('detach/role/{user}', 'RoleController@detachRole');

        Route::get('ticket', 'TicketController@index');
        Route::get('ticket/{ticket}', 'TicketController@show');
        Route::delete('ticket/{ticket}', 'TicketController@destroy');
        Route::post('send/ticket', 'TicketController@sendTicket');
        Route::post('ticket/status/{ticket}', 'TicketController@ticketStatus');

    }); 

    Route::middleware(['auth:api', 'role:3362c127-65aa-4950-b14f-2fc86b53ea88'])->group( function() {
        Route::get('category', 'CategoryController@index');
        Route::get('category/{category}', 'CategoryController@show');
        
        Route::get('product', 'ProductController@index');
        Route::get('product/{product}', 'ProductController@show');

        Route::post('comment', 'CommentController@store');
        
        Route::get('user/{user}', 'UserController@show');
        Route::put('user/{user}', 'UserController@update');
        
        Route::post('send/ticket', 'TicketController@sendTicket');
    }); 

    Route::middleware(['role:customer'])->group( function() {
        Route::get('category', 'CategoryController@index');
        Route::get('category/{category}', 'CategoryController@show');
        
        Route::get('product', 'ProductController@index');
        Route::get('product/{product}', 'ProductController@show');
    }); 
});
