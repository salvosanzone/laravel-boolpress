<?php

use Illuminate\Http\Request;
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

// collego la rotta col controller
//Route::get('posts', 'Api\PostController@index');


// le raggruppo tutte
Route::namespace('Api')
  ->prefix('posts')
  ->group(function(){
    Route::get('/', 'PostController@index');
    Route::get('{slug}', 'PostController@show');

    // creo la rotta legata alla funzione getPostsByCategory() in cui gli passo come parametro lo slug
    Route::get('postcategory/{slug}', 'PostController@getPostsByCategory');
    Route::get('posttag/{slug}', 'PostController@getPostsByTag');
  });
