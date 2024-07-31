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
Route::get('/admin/article', 'AdminController@showArticle');
Route::get('/admin/tag', 'AdminController@showTag');
Route::get('/admin/category', 'AdminController@showCategory');

Route::post('/admin/tag/update', 'TagController@update');
Route::post('/admin/tag/delete', 'TagController@delete');

Route::post('/admin/category/create', 'CategoryController@store');
Route::post('/admin/category/update', 'CategoryController@update');
Route::post('/admin/category/delete', 'CategoryController@delete');

Route::dispatch();