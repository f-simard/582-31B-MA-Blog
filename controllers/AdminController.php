<?php 

namespace App\Controllers;

use App\Models\Article;
use App\Models\User;
use App\Models\Tag;
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

	public function indexArticle() {
		$article = new Article();

		$select=[];

		if($_SESSION['isAdmin'] === 1 ){
			$select= $article->select('updateTimestamp', 'DESC');
		} else {
			$select = $article->selectMultipleByField($_SESSION['idUser'], 'idUser');
		}

		if ($select) {
			return View::render('admin/article', ['articles'=> $select]);
		} else {
			return View::render('error', ['msg'=>"Aucun rticle"]);
		}

	}

	public function indexTag() {
		Auth::isAdmin();

		$tag = new Tag();
		$select = $tag->select();

		if ($select) {
			return View::render('admin/tag', ['tags'=> $select]);
		} else {
			return View::render('error', ['msg'=>"Page not found"]);
		}
	}

	public function indexCategory() {

		Auth::isAdmin();

		$category = new Category();
		$select = $category->select();

		if ($select) {
			return View::render('admin/category', ['categories'=> $select]);
		} else {
			return View::render('error', ['msg'=>"Page not found"]);
		}
	}

	public function indexUser() {

		Auth::isAdmin();

		$user = new User();
		$select = $user->select();

		if ($select) {
			return View::render('admin/user', ['users'=> $select]);
		} else {
			return View::render('error', ['msg'=>"Page not found"]);
		}
	}
}