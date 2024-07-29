<?php 

namespace App\Controllers;
use App\Models\Article;

class ArticleController {

	public function index(){

		$article = new Article;
        $select= $article->select('updateTimestamp', 'DESC');

		$articles = [];

        foreach($select as $row) {
			$categories = $article->getArticleCategory($row['idArticle']);
			$tags = $article->getArticleTag($row['idArticle']);

			if($categories) {
				foreach($categories as $category){
					$row['categoriesLabel'][] = $category['label'];
				}
			};

			if($tags) {
				foreach($tags as $tag){
					$row['tagsLabel'][] = $tag['label'];
				}
			};

			$articles[] = $row;
		
		};

		include('views/article/index.php');
		
	}

}