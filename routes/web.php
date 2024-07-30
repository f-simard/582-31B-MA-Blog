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

Route::post('/tag/update', 'TagController@update');
Route::post('/tag/delete', 'TagController@delete');

Route::dispatch();