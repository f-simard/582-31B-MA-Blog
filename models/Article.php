<?php

namespace App\Models;
use App\Models\CRUD;

class Article extends CRUD {

    protected $table = "Article";
    protected $primaryKey = 'idArticle';
	protected $fillable = ['idUser', 'title', 'content', 'createTimestamp', 'updateTimestamp']; 
	
}