<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::get('/', 'HomeController@index');

Route::get('/admin', 'ProductController@admin');
Route::get('/admin/products', 'ProductController@index');
Route::get('/admin/products/new', 'ProductController@_new');
Route::get('/admin/products/list', 'ProductController@getList');
Route::get('/admin/products/{id}', 'ProductController@_edit');
Route::post('/admin/products/add', 'ProductController@add');
Route::post('/admin/products/edit', 'ProductController@edit');
Route::post('/admin/products/delete', 'ProductController@delete');

Route::get('/admin/users', 'UserController@index');
Route::get('/admin/users/new', 'UserController@_new');
Route::get('/admin/users/list', 'UserController@getList');
Route::get('/admin/users/{id}', 'UserController@_edit');
Route::post('/admin/users/add', 'UserController@add');
Route::post('/admin/users/edit', 'UserController@edit');
Route::post('/admin/users/delete', 'UserController@delete');