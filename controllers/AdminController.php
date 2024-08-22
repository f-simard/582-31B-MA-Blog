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
        $select= $article->select('updateTimestamp', 'DESC');

		if ($select) {
			return View::render('admin/article', ['articles'=> $select]);
		} else {
			return View::render('error', ['msg'=>"Page not found"]);
		}

	}

	public function indexTag() {
		$tag = new Tag();
		$select = $tag->select();

		if ($select) {
			return View::render('admin/tag', ['tags'=> $select]);
		} else {
			return View::render('error', ['msg'=>"Page not found"]);
		}
	}

	public function indexCategory() {

		$category = new Category();
		$select = $category->select();

		if ($select) {
			return View::render('admin/category', ['categories'=> $select]);
		} else {
			return View::render('error', ['msg'=>"Page not found"]);
		}
	}

	public function indexUser() {

		$user = new User();
		$select = $user->select();

		if ($select) {
			return View::render('admin/user', ['users'=> $select]);
		} else {
			return View::render('error', ['msg'=>"Page not found"]);
		}
	}
}