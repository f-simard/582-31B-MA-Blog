<?php 

namespace App\Controllers;

use App\Models\Article;
use App\Models\User;
use App\Models\Tag;
use App\Models\Log;

use App\Models\Category;
use App\Providers\View;
use App\Providers\Auth;


class AdminController {

	public function __construct(){
		Auth::session();
	}

	public function index(){

		return View::render('admin/index');

	}

	public function indexArticle($data = []) {
		$article = new Article();

		$select=[];
		$msg = $this->msg($data);

		if($_SESSION['isAdmin'] === 1 ){
			$select= $article->select('updateTimestamp', 'DESC');
		} else {
			$select = $article->selectMultipleByField($_SESSION['idUser'], 'idUser');
		}

		if ($select) {
			return View::render('admin/article', ['success'=>$msg, 'articles'=> $select]);
		} else {
			return View::render('error', ['msg'=>"Aucun article"]);
		}

	}

	public function indexTag($data = []) {
		Auth::isAdmin();


		$tag = new Tag();
		$select = $tag->select();

		$msg = $this->msg($data);

		if ($select) {
			return View::render('admin/tag', ['success'=>$msg,'tags'=> $select]);
		} else {
			return View::render('error', ['msg'=>"Page not found"]);
		}
	}

	public function indexCategory($data = []) {

		Auth::isAdmin();

		$category = new Category();
		$select = $category->select();

		$msg = $this->msg($data);

		if ($select) {
			return View::render('admin/category', ['success'=>$msg, 'categories'=> $select]);
		} else {
			return View::render('error', ['msg'=>"Page not found"]);
		}
	}

	public function indexUser($data = []) {

		Auth::isAdmin();

		$user = new User();
		$select = $user->select();

		$msg = $this->msg($data);

		if ($select) {
			return View::render('admin/user', ['success'=>$msg, 'users'=> $select]);
		} else {
			return View::render('error', ['msg'=>"Page not found"]);
		}
	}

	public function indexLog() {

		Auth::isAdmin();

		$log = new Log();
		$select = $log->select('createTimestamp', 'DESC');

		if ($select) {
			return View::render('admin/log', ['logs'=> $select]);
		} else {
			return View::render('error', ['msg'=>"Page not found"]);
		}
	}

	public function msg($data = []) {

		if (isset($data['successDelete'])){
			return successDelete;
		} else if (isset($data['successUpdate'])) {
			return successUpdate;
		} else if (isset($data['successAdd'])) {
			 return successAdd;
		} else {
			return null;
		};

	}
}