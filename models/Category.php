<?php

namespace App\Models;
use App\Models\CRUD;

class Category extends CRUD {
    protected $table = "Category";
    protected $primaryKey = 'idArticle';
}