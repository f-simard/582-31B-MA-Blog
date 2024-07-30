<?php 

namespace App\Controllers;

use App\Models\Article;
use App\Models\User;
use App\Models\Tag;
use App\Models\Category;
use App\Providers\View;

class AdminController {

	public function index(){

		return View::render('admin/index');

	}

	public function showArticle() {
		$article = new Article();
        $select= $article->select('updateTimestamp', 'DESC');

		if ($select) {
			return View::render('admin/article', ['articles'=> $select]);
		} else {
			return View::render('error', ['msg'=>"Page not found"]);
		}

	}

	public function showTag() {
		$tag = new Tag();
		$select = $tag->select();

		if ($select) {
			return View::render('admin/tag', ['tags'=> $select]);
		} else {
			return View::render('error', ['msg'=>"Page not found"]);
		}
	}

	public function showCategory() {
		$category = new Category();
		$select = $category->select();

		if ($select) {
			return View::render('admin/category', ['categories'=> $select]);
		} else {
			return View::render('error', ['msg'=>"Page not found"]);
		}
	}
}