<?php 

namespace App\Controllers;

use App\Models\Article;
use App\Models\User;

use App\Providers\View;
use App\Providers\Validator;
use App\Providers\Auth;

class UserController {

	public function create() {

		View::render('user/create');

	}

	public function show($data = []) {

		Auth::session();

		if(isset($data['idUser']) && $data['idUser']!=null){

			$idUser = $data['idUser'];
			
			//récuperer user
			$user = new User();
			$selectedUser = $user->selectByField($idUser);

			if ($selectedUser){

				return View::render('user/show', ['user'=>$selectedUser]);

			} else {
				return View::render('error', ['msg'=>"No record"]);
			}

		} else {
			return View::render('error', ['msg'=>"Page not found"]);
		}

	}

	public function edit($data = []) {

		Auth::session();
		
		if(isset($data['idUser']) && $data['idUser']!=null){

			$idUser = $data['idUser'];
			
			//récuperer user
			$user = new User();
			$selectedUser = $user->selectByField($idUser);

			if ($selectedUser){

				return View::render('user/edit', ['user'=>$selectedUser]);

			} else {
				return View::render('error', ['msg'=>"No record"]);
			}

		} else {
			return View::render('error', ['msg'=>"Page not found"]);
		}

	}

	public function store($data=[]) {

		//valider donnée
		$validator = new Validator();
		// $validator->field('firstName', $data['firstName'], "Prénom")->trim()->min(2)->max(45);
		// $validator->field('lastName', $data['lastName'], "Nom de famille")->trim()->min(2)->max(45);
		// $validator->field('username', $data['username'], "Nom d'usager")->required()->trim()->min(3)->max(45)->unique('User');
		// $validator->field('password', $data['password'], "Mot de passe")->required()->trim()->min(3)->max(45);
		// $validator->field('email', $data['email'], "courriel")->required()->trim()->email()->max(100)->unique('User');
		if ($_FILES['fileToUpload']['size'] !== 0) {
			$validator->field('fileToUpload', $_FILES, "Image")->image($_FILES);
		};


		//donner valeur tinyint à isAdmin
		if(isset($data['isAdmin'])){
			$data['isAdmin'] = 1;
		} else {
			$data['isAdmin'] = 0;
		}
		
		if($validator->isSuccess()){
			//créer utilisateur
			$user = new User();

			//encrypter mot de passe
			$password = $user->hashPassword($data['password']);
			$data['password'] = $password;

			$dir = dirname(__FILE__, 3);
			echo $dir . '<br>';
			$target_file = dirname(__FILE__, 3) . UPLOAD . basename($_FILES["fileToUpload"]["name"]);
			echo $target_file;
			move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
			die();

			//créer utilisateur
			$insertUser = $user->insert($data);

			// return View::redirect('user/show?idUser=' . $insertUser);
			return View::redirect('login');


		} else {

			$errors = $validator->getErrors();

			return View::render('user/create', ['errors'=>$errors, 'user'=>$data]);
		}

	}

	public function update($data, $data_get){

		Auth::session();

		$idUser = $data_get['idUser'];
		print_r($data);

		//valider donnée
		$validator = new Validator();
		$validator->field('firstName', $data['firstName'], "Prénom")->trim()->min(2)->max(45);
		$validator->field('lastName', $data['lastName'], "Nom de famille")->trim()->min(2)->max(45);
		$validator->field('email', $data['email'], "courriel")->trim()->required()->email()->max(100)->unique('User', 'idUser', $idUser);
		if($data['password'] != ''){
			$validator->field('password', $data['password'], "Mot de passe")->trim()->required()->min(3)->max(45);
		} else {
			unset($data['password']);
		}

		//donner valeur tinyint à isAdmin
		if(isset($data['isAdmin'])){
			$data['isAdmin'] = 1;
		} else {
			$data['isAdmin'] = 0;
		}
		
		if($validator->isSuccess()){

			$user = new User();

			//encrypter mot de passe si la donnée est présente dans le tableau
			if(array_key_exists('password', $data)){
				$password = $user->hashPassword($data['password']);
				$data['password'] = $password;
			}

			//mettre à jour utilisateur
			$updateUser = $user->update($data,$idUser);

			return View::redirect('user/show?idUser=' . $idUser);

		} else {

			$errors = $validator->getErrors();

			return View::render('user/edit', ['errors'=>$errors, 'user'=>$data]);
		}

	}

	public function delete($data=[]) {

		Auth::session();

		if(isset($data['idUser']) && $data['idUser']!=null) {

			$idUser = $data['idUser'];

			$user = new User();
			$deleteUser = $user->delete($idUser);

			if($deleteUser) {
				return View::redirect('admin/user');
			} else {
				$errors['msg'] = 'Erreur lors de la suppression';
				$select = $user->select();
				return View::render('admin/user', ['errors'=>$errors, 'users'=>$select]);
			}
		} else {
			return View::render('error', ['msg'=>'Record does not exist']);
		}

	}

}