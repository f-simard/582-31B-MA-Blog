<?php
use App\Controllers;
use App\Routes\Route;

Route::get('', 'ArticleController@index');
Route::get('/article/create', 'ArticleController@create');
Route::post('/article/create', 'ArticleController@store');
Route::get('/article/show', 'ArticleController@show');

Route::get('/admin', 'AdminController@index');

Route::dispatch();