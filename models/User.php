<?php

namespace App\Models;
use App\Models\CRUD;

class User extends CRUD {
	
	protected $table = "User";
	protected $primaryKey = 'idUser';
	protected $fillable = ['username', 'lastName', 'firstName', 'email', 'password', 'isAdmin', 'avatar']; 
	private $salt = 'a7w99&';
	
	/*encrypter les mots de passe*/
	public function hashPassword($password, $cost = 10){
		$options = [
			'cost' => $cost
		];
		
		return password_hash($password.$this->salt, PASSWORD_BCRYPT, $options);
	}
	
	
	/* authentifier l'utilisteur */
	public function checkuser($username, $password){

		$user = $this->unique('username', $username);
		
		if ($user){
			if(password_verify($password.$this->salt, $user['password'])){
				
				session_regenerate_id();
				$_SESSION['idUser'] = $user['idUser'];
				$_SESSION['username'] = $user['username'];
				$_SESSION['isAdmin'] = $user['isAdmin'];
				$_SESSION['name'] = $user['firstName'];
				$_SESSION['fingerPrint'] = md5($_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR']);

				return true;
				
			} else {
				return false;
			}
			return $user;
		} else {
			return false;
		}
		
	}
}