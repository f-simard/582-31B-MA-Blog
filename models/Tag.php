<?php

namespace App\Models;
use App\Models\CRUD;

class Tag extends CRUD {

    protected $table = "Tag";
    protected $primaryKey = 'idTag';
	protected $fillable = ['label']; 
	
}