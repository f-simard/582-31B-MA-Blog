<?php
require_once('controllers/ArticleController.php');
require_once('routes/Route.php');

Route::get('/article', 'ArticleController@index');