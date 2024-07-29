<?php 

namespace App\Controllers;

use App\Models\Article;
use App\Providers\View;

class ArticleController {

	public function index(){

		$article = new Article;
        $select= $article->select('updateTimestamp', 'DESC');

		$articles = [];

		if ($select) {

			foreach($select as $row) {
				$categories = $article->getArticleCategory($row['idArticle']);
				$tags = $article->getArticleTag($row['idArticle']);
	
				if($categories) {
					foreach($categories as $category){
						$row['categories'][] = $category['label'];
					}
				};
	
				if($tags) {
					foreach($tags as $tag){
						$row['tags'][] = $tag['label'];
					}
				};
	
				$articles[] = $row;
			
			};

			// echo "<pre>";
			// print_r($articles);
			// echo "</pre>";

			return View::render('article/index', ['articles'=> $articles]);

		}

		return View::render('error');

	}
}