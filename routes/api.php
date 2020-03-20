<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/products', 'ListController@products');
Route::post('/products/{id}', 'ListController@product');

Route::post('/media', 'MediaController@index');
Route::post('/media/delete', 'MediaController@delete');
/*Route::delete('/media', 'MediaController@delete');*/
