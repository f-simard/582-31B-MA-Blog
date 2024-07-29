<?php

namespace App\Models;
use App\Models\CRUD;

class User extends CRUD {
    protected $table = "User";
    protected $primaryKey = 'idUser';
}