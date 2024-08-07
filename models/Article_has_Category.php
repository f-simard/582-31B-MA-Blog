<?php

namespace App\Models;
use App\Models\CRUD;

class Article_has_Category extends CRUD {

    protected $table = "Article_has_Category";
	protected $fillable = ['idArticle', 'idCategory']; 
	
}