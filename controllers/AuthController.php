<?php
namespace App\Controllers;

use App\Models\Client;
use App\Models\User;
use App\Providers\View;
use App\Providers\Validator;

class AuthController {

    public function index() {
        View::render('auth/index');
    }
    

    public function store($data=[]){

    	//valider donnée
		$validator = new Validator();
		$validator->field('username', $data['username'])->trim()->required()->max(50)->exist('User','username');
		$validator->field('password', $data['password'])->trim()->required()->min(4)->max(255);


		if($validator->isSuccess()){

			$user = new User;
			$checkUser = $user->checkuser($data['username'], $data['password']);

			//print_r($checkUser);

			if($checkUser){

				return View::redirect('admin/article');
			} else {
				$errors['message'] = 'Please check your credentials';
				return View::render('auth/index', ['errors'=>$errors, 'user'=>$data]);
			}

		} else {
			$errors = $validator->getErrors();
	
			return View::render('auth/index', ['errors'=>$errors, 'user'=>$data]);

		}
	}

	public function delete(){
		session_destroy();
		return View::redirect('login');
	}
}

