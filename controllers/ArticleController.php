<?php 

namespace App\Controllers;
use App\Models\Article;

class ArticleController {

	public function index(){

		$article = new Article;
        $select= $article->select();
        print_r($select);

		//include('views/article-index.php');
	}

}