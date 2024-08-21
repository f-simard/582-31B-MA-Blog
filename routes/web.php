<?php
use App\Controllers;
use App\Routes\Route;

Route::get('', 'ArticleController@index');
Route::get('/article/create', 'ArticleController@create');
Route::post('/article/create', 'ArticleController@store');
Route::get('/article/show', 'ArticleController@show');
Route::get('/article/edit', 'ArticleController@edit');
Route::post('/article/edit', 'ArticleController@update');
Route::post('/article/delete', 'ArticleController@delete');

Route::get('/admin', 'AdminController@index');
Route::get('/admin/article', 'AdminController@indexArticle');
Route::get('/admin/tag', 'AdminController@indexTag');
Route::get('/admin/category', 'AdminController@indexCategory');
Route::get('/admin/user', 'AdminController@indexUser');

Route::post('/admin/tag/update', 'TagController@update');
Route::post('/admin/tag/delete', 'TagController@delete');

Route::post('/admin/category/create', 'CategoryController@store');
Route::post('/admin/category/update', 'CategoryController@update');
Route::post('/admin/category/delete', 'CategoryController@delete');

Route::post('/admin/user/delete', 'UserController@delete');
Route::get('/user/create', 'UserController@create');
Route::post('/user/create', 'UserController@store');
Route::get('/user/show', 'UserController@show');
Route::get('/user/edit', 'UserController@edit');
Route::post('/user/edit', 'UserController@update');

Route::get('/login', 'AuthController@index');
Route::post('/login', 'AuthController@store');
Route::get('/logout', 'AuthController@delete');

Route::dispatch();