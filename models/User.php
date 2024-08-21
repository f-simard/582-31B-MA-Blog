<?php

namespace App\Models;
use App\Models\CRUD;

class User extends CRUD {
	
	protected $table = "User";
	protected $primaryKey = 'idUser';
	protected $fillable = ['username', 'lastName', 'firstName', 'email', 'password', 'isAdmin']; 
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
		print_r($user);
		echo '<br>';
		echo $this->hashPassword($password);
		echo '<br>';
		echo $user['password'];
		echo '<br>';
		echo(password_verify($password.$this->salt, $user['password']));
		
		if ($user){
			if(password_verify($password.$this->salt, $user['password'])){
				
				session_regenerate_id();
				$_SESSION['user_id'] = $user['id'];
				// $_SESSION['name'] = $user['name'];
				// $_SESSION['fingerPrint'] = md5($_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR']); //checker si la meme machine sur la meme connexion + encrypter
				
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