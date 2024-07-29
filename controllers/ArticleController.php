<?php 

namespace App\Controllers;

use App\Models\Article;
use App\Models\User;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Article_has_Category;
use App\Models\Article_has_Tag;
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
			
			return View::render('article/index', ['articles'=> $articles]);

		}

		return View::render('error');

	}

	public function show() {
		echo 'article show';
	}

	public function create() {
		$article = new Article;

		$category = new Category;
		$select = $category->select();

		View::render('article/create', ['categories'=>$select]);
	}

	public function store() {

		$data = [];

		$data['content'] = $_POST['content'];
		$data['title'] = $_POST['title'];


		//vérifier si utilsateur existe, sinon le créer
		$user = new User;
		$selectUsers = $user->select();
		$users = [];

		foreach($selectUsers as $row) {
			$users[$row['idUser']] = $row['username'];
		}

		if(in_array($_POST['username'],$users)){
			$data['idUser'] = array_search($_POST['username'], $users);
		} else {
			$userData['username'] = $_POST['username'];
			$insertedUser = $user->insert($userData);
			$data['idUser'] = $insertedUser;
		}

		//créer l'article 
		$article = new Article;
		$insertedArticle = $article->insert($data);

		//récupérer les tags dans la base de données
		$tag = new Tag;
		$selectTags = $tag->select();
		$tags = [];

		foreach ($selectTags as $selectTag){
			$tags[$selectTag['idTag']] = $selectTag['label'];
		}

		$submittedTags = explode(";", $_POST['tag']);
		//https://www.geeksforgeeks.org/how-to-trim-all-strings-in-an-array-in-php/
		$submittedTagsClean = array_map('trim', $submittedTags);

		if($insertedArticle){

			//ajouter la relation article-categorie
			foreach($_POST as $key=>$value){
				if (substr($key, 0, 3) === 'cat'){
					$idCategory = substr($key, 3);
					$relationCategory['idCategory'] = $idCategory;
					$relationCategory['idArticle'] = $insertedArticle;

					$article_has_category = new Article_has_Category;
					$insertedCategoryRelation = $article_has_category->insert($relationCategory);
				};
			}

				//verifier si le tag existe deja dans la base de donner
				$insertTag = [];

				foreach($submittedTagsClean as $submittedTagClean){

					if (in_array($submittedTagClean, $tags)) {
						$relationTag['idTag'] = array_search($submittedTagClean, $tags);

					} else {
						$insertTag['label'] = $submittedTagClean;
						$newTag = $tag->insert($insertTag);
						$relationTag['idTag'] = $newTag;
					}
					$relationTag['idArticle'] = $insertedArticle;
					$article_has_tag = new Article_has_Tag;
					$insertTagRelation = $article_has_tag->insert($relationTag);
				}
			return View::redirect('article/show?articleId' . $insertedArticle);

		} else {

			echo 'error';

		}

	echo 'error';

	}
}