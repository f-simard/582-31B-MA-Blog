<?php

namespace App\Models;
use App\Models\CRUD;

class Article_has_Tag extends CRUD {

    protected $table = "Article_has_Tag";
	protected $fillable = ['idArticle', 'idTag']; 
	
}