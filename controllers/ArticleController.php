<?php 

namespace App\Controllers;

use App\Models\Article;
use App\Models\User;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Article_has_Category;
use App\Models\Article_has_Tag;

use App\Providers\View;
use App\Providers\Validator;

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

	public function show($data = []) {

		if(isset($data['idArticle']) && $data['idArticle']!=null){
			
			//récuperer article
			$idArticle = $data['idArticle'];

			$article = new Article;
			$selectedArticle = $article->selectByField($idArticle);

			if ($selectedArticle){
				
			//recuperer autheur
			$auteur = $article->getArticleAuthor($idArticle);
			$auteurString;
			if (!$auteur) {
				$auteurString = "auteur supprimé";
			} else if (!$auteur[0]['firstName']  && !$auteur[0]['lastName']) {
				$auteurString = $auteur[0]['username'];
			} else {
				$auteurString = $auteur[0]['firstName'] . ' ' . $auteur[0]['lastName'];
			}

			//récrupérer catégories
			$getCategories = $article->getArticleCategory($idArticle);
			if ($getCategories){
				$categories = [];
				foreach($getCategories as $category){
					$categories[] = $category['label'];
				}
				$categoriesString = implode(", ", $categories);
			} else {
				$categoriesString  = "Sans catégorie";
			}

			//récuprérer tags
			$getTags = $article->getArticleTag($idArticle);
			if ($getTags){
				$tags = [];
				foreach($getTags as $tag){
					$tags[] = $tag['label'];
				}

				$tagsString = implode(",", $tags);
			} else {
				$tagsString = "Sans tag";
			}

			return View::render('article/show', ['article'=>$selectedArticle, 'auteur'=>$auteurString, 'categoriesString'=>$categoriesString, 'tagsString'=>$tagsString]);
			} else {
				return View::render('error', ['msg'=>"No data"]);
			}

		} else {
			return View::render('error', ['msg'=>"Page not found"]);
		}
	}

	public function create() {

		$category = new Category;
		$select = $category->select();

		View::render('article/create', ['categories'=>$select]);
	}

	public function store($data=[]) {

		//valider donnée
		$validator = new Validator();
		$validator->field('username', $data['username'], "Nom d'usager")->trim()->min(3)->max(45);
		$validator->field('content', $data['content'], "Contenu")->trim()->min(3);
		$validator->field('title', $data['title'], "Titre")->trim()->min(3)->max(120);
		
		if($validator->isSuccess()){

			$newData['content'] = $data['content'];
			$newData['title'] = $data['title'];

			//vérifier si utilsateur existe, sinon le créer
			$user = new User;
			$selectUsers = $user->select();
			$users = [];

			foreach($selectUsers as $row) {
				$users[$row['idUser']] = $row['username'];
			}

			if(in_array($data['username'],$users)){
				$newData['idUser'] = array_search($data['username'], $users);
			} else {
				$userData['username'] = $data['username'];
				$insertedUser = $user->insert($userData);
				$newData['idUser'] = $insertedUser;
			}

			//créer l'article 
			$article = new Article;
			$insertedArticle = $article->insert($newData);

			//récupérer les tags dans la base de données
			$tag = new Tag;
			$selectTags = $tag->select();
			$tags = [];

			foreach ($selectTags as $selectTag){
				$tags[$selectTag['idTag']] = $selectTag['label'];
			}

			$submittedTags = [];
			if( $data['tag'] ) {
				$submittedTags = explode(";", $data['tag']);
				//https://www.geeksforgeeks.org/how-to-trim-all-strings-in-an-array-in-php/
				$submittedTagsClean = array_map('trim', $submittedTags);
			}

			if($insertedArticle){

				//ajouter la relation article-categorie
				foreach($data as $key=>$value){
					if (substr($key, 0, 3) === 'cat'){
						$idCategory = substr($key, 3);
						$relationCategory['idCategory'] = $idCategory;
						$relationCategory['idArticle'] = $insertedArticle;

						$article_has_category = new Article_has_Category;
						$insertedCategoryRelation = $article_has_category->insert($relationCategory);
					};
				}

				if ( $data['tag']){
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
				}

				return View::redirect('article/show?idArticle=' . $insertedArticle);
			} else {
				return View::render('error', ['msg'=>"Erreur à la soumission"]);
			}

		} else {
			$errors = $validator->getErrors();

			$category = new Category;
			$select = $category->select();

			return View::render('article/create', ['errors'=>$errors, 'article'=>$data, 'categories'=>$select]);
		}

	}

	public function edit($data = []){

		if(isset($data['idArticle']) && $data['idArticle']!=null){
		
			//récuperer article
			$idArticle = $data['idArticle'];

			$article = new Article;
			$selectedArticle = $article->selectByField($idArticle);

			if ($selectedArticle){

				//recuperer autheur
				$auteur = $article->getArticleAuthor($idArticle);
				$auteurString;
				if (!$auteur) {
					$auteurString = "auteur supprimé";
				} else if (!$auteur[0]['firstName']  && !$auteur[0]['lastName']) {
					$auteurString = $auteur[0]['username'];
				} else {
					$auteurString = $auteur[0]['firstName'] . ' ' . $auteur[0]['lastName'];
				}

				//get categories and article categories
				$category = new Category();
				$allCategories = $category->select();

				$articleCategories = $article->getArticleCategory($idArticle);
				$articleCategoriesId = [];
				if ($articleCategories ) {
					foreach($articleCategories as $articleCategoryId){
						$articleCategoriesId[] = $articleCategoryId['idCategory'];
					}
				}

				if ($allCategories) {
					foreach($allCategories as &$categorie){
						$categorie['checked'] = 0;
						if (in_array($categorie['idCategory'], $articleCategoriesId)) {
							$categorie['checked'] = 1;
						}
					}
				}

				//récuprérer tags associés à l'article
				$getTags = $article->getArticleTag($idArticle);
				if ($getTags){
					$tags = [];
					foreach($getTags as $tag){
						$tags[] = $tag['label'];
					}
					$tagsString = implode("; ", $tags);
					$tagsString = rtrim($tagsString, '; ');
				} else {
					$tagsString = "";
				}
				return View::render('article/edit', ['article'=>$selectedArticle, 'auteur'=>$auteurString, 'categories'=>$allCategories,'tagsString'=>$tagsString]);
			} else {
				return View::render('error', ['msg'=>"No data"]);
			}

		} else {
			return View::render('error', ['msg'=>"Page not found"]);
		}
	}

	public function update($data, $data_get){

		//delete categorie and tag relations and insert again
		if(isset($data_get['idArticle']) && $data_get['idArticle']!=null) {

		//valider donnée
		$validator = new Validator();
		$validator->field('content', $data['content'], "Contenu")->min(3);
		$validator->field('title', $data['title'], "Titre")->min(3)->max(120);
		
		if($validator->isSuccess()){

			$idArticle = $data_get['idArticle'];

			$article = new Article();
			$updateArticle = $article->update($data, $idArticle);

			$idArticle = $data_get['idArticle'];

			$article_has_tag = new Article_has_Tag();
			$deleteArticleTagRelation = $article_has_tag->delete($idArticle, 'idArticle');

			$article_has_category = new Article_has_Category();
			$deleteArticleCategoryRelation = $article_has_category->delete($idArticle, 'idArticle');

			if($deleteArticleTagRelation && $deleteArticleCategoryRelation) {
				
				//recuperer tag dans la base de donnee
				$tag = new Tag;
				$selectTags = $tag->select();
				$tags = [];

				foreach ($selectTags as $selectTag){
					$tags[$selectTag['idTag']] = $selectTag['label'];
				}

				$submittedTags = [];
				if( $data['tag'] ) {
					$submittedTags = explode(";", $data['tag']);
					//https://www.geeksforgeeks.org/how-to-trim-all-strings-in-an-array-in-php/
					$submittedTagsClean = array_map('trim', $submittedTags);
				}
				//ajouter la relation article-categorie
				foreach($data as $key=>$value){
					if (substr($key, 0, 3) === 'cat'){
						$idCategory = substr($key, 3);
						$relationCategory['idCategory'] = $idCategory;
						$relationCategory['idArticle'] = $idArticle;

						$article_has_category = new Article_has_Category;
						$insertedCategoryRelation = $article_has_category->insert($relationCategory);
					};
				}

				if( $data['tag'] ) {

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
						$relationTag['idArticle'] = $idArticle;
						$article_has_tag = new Article_has_Tag;
						$insertTagRelation = $article_has_tag->insert($relationTag);
					}
				}
				return View::redirect('article/show?idArticle=' . $idArticle);

			} else {

				return View::render('error', ['msg'=>"Erreur lors de la mise à jour de l'article"]);
			}
		} else {
			$errors = $validator->getErrors();

			$category = new Category;
			$select = $category->select();

			return View::render('article/edit', ['errors'=>$errors, 'article'=>$data, 'categories'=>$select]);
		}

		} else {
			return View::render('error', ['msg'=>'Record does not exist']);
		}
	}

	
	public function delete($data){

		if(isset($data['idArticle']) && $data['idArticle']!=null) {

			$idArticle = $data['idArticle'];

			$article_has_tag = new Article_has_Tag();
			$deleteArticleTagRelation = $article_has_tag->delete($idArticle, 'idArticle');

			$article_has_category = new Article_has_Category();
			$deleteArticleCategoryRelation = $article_has_category->delete($idArticle, 'idArticle');

			$article = new Article();
			$deleteArticle = $article->delete($idArticle);


			if($deleteArticle && $deleteArticleTagRelation && $deleteArticleCategoryRelation) {
				return View::redirect('admin/article');
			} else {
				return View::render('error');
			}
		} else {
			return View::render('error', ['msg'=>'Record does not exist']);
		}
	}

}