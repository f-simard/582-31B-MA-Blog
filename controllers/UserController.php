<?php 

namespace App\Controllers;

use App\Models\Article;
use App\Models\User;
use App\Providers\View;
use App\Providers\Validator;

class UserController {

	public function create() {

		View::render('user/create');

	}

	public function show($data = []) {

		
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
		$validator->field('firstName', $data['firstName'], "Prénom")->trim()->min(2)->max(45);
		$validator->field('lastName', $data['lastName'], "Nom de famille")->trim()->min(2)->max(45);
		$validator->field('username', $data['username'], "Nom d'usager")->required()->trim()->min(3)->max(45)->unique('User');
		$validator->field('password', $data['password'], "Mot de passe")->required()->trim()->max(45);
		$validator->field('email', $data['email'], "courriel")->required()->trim()->email()->max(100)->unique('User');

		//donner valeur tinyint à isAdmin
		if(isset($data['isAdmin'])){
			$data['isAdmin'] = 1;
		} else {
			$data['isAdmin'] = 0;
		}
		
		if($validator->isSuccess()){

			//créer utilisateur
			$user = new User();
			$insertUser = $user->insert($data);

			return View::redirect('user/show?idUser=' . $insertUser);

		} else {

			$errors = $validator->getErrors();

			return View::render('user/create', ['errors'=>$errors, 'user'=>$data]);
		}

	}

	public function update($data, $data_get){
		$idUser = $data_get['idUser'];

		//valider donnée
		$validator = new Validator();
		$validator->field('firstName', $data['firstName'], "Prénom")->trim()->min(2)->max(45);
		$validator->field('lastName', $data['lastName'], "Nom de famille")->trim()->min(2)->max(45);
		$validator->field('password', $data['password'], "Mot de passe")->required()->trim()->max(45);
		$validator->field('email', $data['email'], "courriel")->required()->trim()->email()->max(100)->unique('User', 'idUser', $idUser);

		//donner valeur tinyint à isAdmin
		if(isset($data['isAdmin'])){
			$data['isAdmin'] = 1;
		} else {
			$data['isAdmin'] = 0;
		}
		
		if($validator->isSuccess()){

			//mettre à jour utilisateur
			$user = new User();
			$updateUser = $user->update($data,$idUser);

			return View::redirect('user/show?idUser=' . $idUser);

		} else {

			$errors = $validator->getErrors();

			return View::render('user/edit', ['errors'=>$errors, 'user'=>$data]);
		}

	}

	public function delete($data=[]) {

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