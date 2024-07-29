<?php
use App\Controllers;
use App\Routes\Route;

Route::get('/article', 'ArticleController@index');

Route::dispatch();