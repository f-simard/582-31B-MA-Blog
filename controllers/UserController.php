<?php 

namespace App\Controllers;

use App\Models\Article;
use App\Models\User;
use App\Providers\View;

class UserController {

	public function create() {

		View::render('user/create');

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