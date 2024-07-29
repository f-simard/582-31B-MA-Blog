<?php 

namespace App\Controllers;

use App\Models\Article;
use App\Models\User;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Article_has_Category;
use App\Models\Article_has_Tag;
use App\Providers\View;

class AdminController {

	public function index(){

		return View::render('admin/index');

	}

	public function showArticle() {
		$article = new Article;
        $select= $article->select('updateTimestamp', 'DESC');

		if ($select) {
			return View::render('admin/article', ['articles'=> $select]);
		} else {
			return View::render('error');
		}

	}

}