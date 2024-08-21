<?php

namespace App\Models;
use App\Models\CRUD;

class User extends CRUD {
	
	protected $table = "User";
	protected $primaryKey = 'idUser';
	protected $fillable = ['username', 'lastName', 'firstName', 'email', 'password', 'isAdmin']; 
	private $salt = 'a7w99&';
	
	public function hashPassword($password, $cost = 10){
		$options = [
			'cost' => $cost
		];
		
		return password_hash($password.$this->salt, PASSWORD_BCRYPT, $options);
	}
	
}